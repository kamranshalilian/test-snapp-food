<?php

namespace App\Http\Controllers;

use App\Enum\DelayStatusEnum;
use App\Http\Requests\AlertRequest;
use App\Http\Requests\AssignRequest;
use App\Http\Resources\VendorResource;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Vendor;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class DelayController extends Controller
{
    public function report()
    {
        $sumQuery = Order::selectRaw('sum(time_daley)')
            ->whereColumn('vendor_id', 'vendors.id')
            ->getQuery();

        $vendor = Vendor::with(["orders" => function ($q) {
            $q->where("time_daley", ">", 0)
                ->whereDate("created_at", ">=", Carbon::now()->subWeek()->format("Y-m-d"));
        }, "delayReports"])->select("vendors.*")
            ->selectSub($sumQuery, "total_daley")
            ->whereHas("orders", function (Builder $q) {
                $q->where("time_daley", ">", 0)
                    ->whereDate("created_at", ">=", Carbon::now()->subWeek()->format("Y-m-d"));
            })->orWhereHas("delayReports", function (Builder $q) {
                $q->whereDate("created_at", ">=", Carbon::now()->subWeek()->format("Y-m-d"));
            })
            ->orderByDesc("total_daley")
            ->get();
        return VendorResource::collection($vendor);
    }

    public function alert(AlertRequest $request)
    {
        try {
            $order = $request->order;
            if ($request->has_trip_and_status == "use_api") {
                $api = Http::get("https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7");
                throw_if($api->status() != 200, "mocky api don't work");
                $time = $api->json()["data"]["eta"];
                $order->update([
                    "time_daley" => $order->time_daley + $time
                ]);
                return response()->json([
                    "message" => "please be patient for $time minutes",
                ]);
            }
            $order->delayReports()->create([
                "vendor_id" => $order->vendor?->id
            ]);

            return response()->json([
                "message" => "you are in daley queue our agent call you soon",
            ], 201);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }


    }

    public function assign(AssignRequest $request)
    {
        try {
            $delayReport = DelayReport::with("order.vendor")
                ->where("status", DelayStatusEnum::PENDING->value)
                ->orderBy("created_at")
                ->first();

            throw_if(is_null($delayReport), "there has not Report");

            $delayReport->update([
                "agent_id" => $request->agent_id,
                "status" => DelayStatusEnum::ASSIGNED->value,
            ]);

            $delayReport->order->update([
                "agent_id" => $request->agent_id
            ]);

            return response()->json([
                "message" => "we assign one order to you",
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
