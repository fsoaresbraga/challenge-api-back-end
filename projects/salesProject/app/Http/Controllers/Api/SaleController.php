<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Unity;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\FilterSaleRequest;
use App\Http\Resources\DetailsSaleResource;

class SaleController extends Controller
{

    public function index(FilterSaleRequest $request) {
        $req = $request->validated();

        $dateStart = Carbon::createFromFormat('d/m/Y', $req['date_start'])->startOfDay()->format('Y-m-d H:i:s');
        $dataEnd = Carbon::createFromFormat('d/m/Y', $req['date_end'])->endOfDay()->format('Y-m-d H:i:s');

        $query = Sale::with('user.company.unity.director')->whereBetween('date_sale', [$dateStart, $dataEnd]);

        //filtro para vendedores
        if(Gate::allows('isSalesman', Sale::class)) {

            return $this->filterBySalesman($query, $req);
        }

        //filtro para gerente
        if(Gate::allows('isManager', Sale::class)) {

            return $this->filterByManager($query, $req);
        }

        //filtro para diretor
        if(Gate::allows('isDirector', Sale::class)) {

            return $this->filterByDirector($query, $req);
        }

        //diretor geral
        if(!is_null($req['user'])) {
            $query->where('user_id', $req['user']);
        }

        if(!is_null($req['unity'])) {
            $query->whereHas('user.company.unity', function($q) use($req){
                $q->where('id', $req['unity']);
            });
        }

        if(!is_null($req['director'])) {
            $query->whereHas('user.company.unity.director', function($q) use($req){
                $q->where('id', $req['director']);
            });
        }

        return SaleResource::collection($query->get());

    }

    public function store(StoreRequest $request) {


        $req = $request->validated();

        try {

            if(!Gate::allows('isSalesman', Sale::class)) {
                return response()->json(['errors' => ['message' => config('messages.errorRegisteringSale.message')]], config('messages.errorRegisteringSale.statusCode'));
            }

            $calculateDistance = $this->calculateUnitDistance($req['latitude'],$req['longitude']);
            $convertValue = $this->convertDecimalValue($request['value']);

            if($convertValue == 0.0) {

                return response()->json(['errors' => ['message' => config('messages.saleValueNotAccepted.message')]],config('messages.saleValueNotAccepted.statusCode'));
            }

            $sale = new Sale();
            $sale->user_id = Auth::user()->id;
            $sale->date_sale = Carbon::createFromFormat('d/m/Y H:i:s', $request['date_sale'])->format('Y-m-d H:i:s');
            $sale->value = $this->convertDecimalValue($request['value']);
            $sale->latitude = $request->latitude;
            $sale->longitude = $request->longitude;
            $sale->roaming = $calculateDistance['unityName'] == Auth::user()->company->unity->nome ? null : $calculateDistance['unityName'];
            $sale->save();

            return response()->json(['success' => ['message' => config('messages.saleCreated.message')]],config('messages.saleCreated.statusCode'));

        } catch(Exception $e) {

            Log::error($e);

            return response()->json(['errors' => ['message' => config('messages.unavailableService.message')]],config('messages.unavailableService.statusCode'));

        }


    }

    public function show(Sale $sale) {

        if(!Gate::allows('canViewSale', [Sale::class, $sale])) {
            return response()->json(['errors' => ['message' => config('messages.cantSeeSale.message') ]], config('messages.cantSeeSale.statusCode'));
        }

        $sale = Sale::with('user.company.unity')->find($sale->id);
        return new DetailsSaleResource($sale);
    }

    private function calculateUnitDistance($latitude, $longitude) {

        $locations = [];
        $units = Unity::get();

        foreach($units as $unity) {

            $lat1 = deg2rad($latitude);
            $lat2 = deg2rad($unity->latitude);
            $lon1 = deg2rad($longitude);
            $lon2 = deg2rad($unity->longitude);

            $dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2)));
            $dist = number_format($dist, 2, '.', '');

            array_push($locations,  ['unityName' => $unity->name, 'distance' => $dist]);
        }
        $min = array_reduce($locations, function($min, $details) {

            return min($min, $details['distance']);

        }, PHP_INT_MAX);

        $locationMin = array_filter($locations, function ($local) use($min){
            return $local['distance'] == $min;
        });

        return array_values($locationMin)[0];

    }

    private function convertDecimalValue($money) {

        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

        return (float) str_replace(',', '.', $removedThousandSeparator);
    }

    private function filterBySalesman($query, $req) {

        if(!is_null($req['user']) && $req['user'] != Auth::user()->id) {
            return response()->json(['errors' => ['message' => config('messages.errorViewSaleSalesman.message')]],config('messages.errorViewSaleSalesman.statusCode'));
        }

        if(!is_null($req['unity']) && $req['unity'] != Auth::user()->company->unity->id) {
            return response()->json(['errors' => [config('messages.errorViewSaleByUnity.message')]],config('messages.errorViewSaleByUnity.statusCode'));
        }

        if(!is_null($req['director']) && $req['director'] != Auth::user()->company->unity->director->id) {
            return response()->json(['errors' => [config('messages.errorViewSaleByDirector.message')]],config('messages.errorViewSaleByDirector.statusCode'));
        }

        $query->where('user_id', Auth::user()->id);

        return SaleResource::collection($query->get());

    }

    private function filterByManager($query, $req) {
        $authenticatedUserUnitId = Auth::user()->company->unity->id;

            if(!is_null($req['user'])) {

                $userIsFromUnity = User::whereHas('company.unity', function($q) use($authenticatedUserUnitId) {
                    $q->where('id', $authenticatedUserUnitId);
                })->find($req['user']);

                if(is_null($userIsFromUnity)) {
                    return response()->json(['errors' => ['message' => config('messages.errorViewSaleSalesmanByUnity.message')]],config('messages.errorViewSaleSalesmanByUnity.statusCode'));
                }

                $query->where('user_id', $userIsFromUnity->id);

            }

            if(!is_null($req['unity']) && $req['unity'] != Auth::user()->company->unity->id) {
                return response()->json(['errors' => [config('messages.errorViewSaleByUnity.message')]],config('messages.errorViewSaleByUnity.statusCode'));
            }

            if(!is_null($req['director']) && $req['director'] != Auth::user()->company->unity->director->id) {
                return response()->json(['errors' => [config('messages.errorViewSaleByDirector.message')]],config('messages.errorViewSaleByDirector.statusCode'));
            }

            $query->whereHas('user.company.unity', function($q) use($authenticatedUserUnitId){
                $q->where('id', $authenticatedUserUnitId);
            });

            return SaleResource::collection($query->get());
    }

    private function filterByDirector($query, $req) {

        $authenticatedUserDirectorId = Auth::user()->company->unity->director->id;

        if(!is_null($req['user'])) {

            $userIsFromUnity = User::whereHas('company.unity.director', function($q) use($authenticatedUserDirectorId) {
                $q->where('id', $authenticatedUserDirectorId);
            })->find($req['user']);

            if(is_null($userIsFromUnity)) {
                return response()->json(['errors' => [config('messages.errorViewSaleSalesmanByDirector.message')]],config('messages.errorViewSaleSalesmanByDirector.statusCode'));
            }

            $query->where('user_id', $userIsFromUnity->id);
        }

        if(!is_null($req['unity'])) {

            $unity = Unity::whereHas('director', function($q) use($authenticatedUserDirectorId){
                $q->where('id', $authenticatedUserDirectorId);
            })->find($req['unity']);

            if(is_null($unity)) {
                return response()->json(['errors' => [config('messages.errorViewSaleByUnity.message')]],config('messages.errorViewSaleByUnity.statusCode'));
            }

            $query->whereHas('user.company.unity', function($q) use($unity){
                $q->where('id', $unity->id);
            });
        }

        if(!is_null($req['director']) && $req['director'] != Auth::user()->company->unity->director->id) {
            return response()->json(['errors' => [config('messages.errorViewSaleByDirector.message')]],config('messages.errorViewSaleByDirector.statusCode'));
        }

        $query->whereHas('user.company.unity.director', function($q) use($authenticatedUserDirectorId){
            $q->where('id', $authenticatedUserDirectorId);
        });

        return SaleResource::collection($query->get());

    }

}
