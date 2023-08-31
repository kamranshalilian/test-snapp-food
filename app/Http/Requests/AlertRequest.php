<?php

namespace App\Http\Requests;

use App\Enum\TripStatusEnum;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;


class AlertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "order_id" => ["required", "exists:orders,id", function ($attribute, $value, $fail) {
                try {
                    $order = Order::with(["trip", "vendor"])->withCount("trip")->where("id", $value)->first();
                    $this->merge([
                        "order" => $order
                    ]);
                    $time = $order->time_delivery + $order->time_daley;
                    $data = Carbon::now()->subMinutes($time)->timestamp;
                    $now = Carbon::now()->timestamp;

                    if (($order?->created_at?->timestamp <= $now && $order?->created_at?->timestamp >= $data)) {
                        $fail("The order time is not over yet");
                    }
                    if ($order->trip_count && in_array($order?->trip?->status, [TripStatusEnum::ASSIGNED->value, TripStatusEnum::PICKED->value, TripStatusEnum::AT_VENDOR->value])) {
                        $this->merge([
                            "has_trip_and_status" => "use_api"
                        ]);
                    } elseif (!$order->trip_count || ($order->trip_count && in_array($order?->trip?->status, [TripStatusEnum::DELIVERED->value]))) {
                        $this->merge([
                            "has_trip_and_status" => "in_queue"
                        ]);
                    } else {
                        $fail("you can't record a delay");
                    }

                } catch (\Exception $exception) {
                    $fail("There is no order");
                }
            }]
        ];
    }
}
