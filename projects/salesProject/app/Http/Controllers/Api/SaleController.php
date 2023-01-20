<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Unity;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class SaleController extends Controller
{
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

}
