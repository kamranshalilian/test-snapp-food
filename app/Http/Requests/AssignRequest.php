<?php

namespace App\Http\Requests;

use App\Enum\DelayStatusEnum;
use App\Models\Agent;
use App\Models\DelayReport;
use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            "agent_id" => ["required", "exists:agents,id", function ($attribute, $value, $fail) {
                try {
                    $agent = Agent::with("delayReports")->find($value);
                    $count = $agent->delayReports?->where("status", DelayStatusEnum::ASSIGNED->value)?->count();
                    if ($count) {
                        $fail("This agent is busy");
                    }
                    $delayReportStatusPendingCount = DelayReport::where("status", DelayStatusEnum::PENDING->value)->count();
                    if (!$delayReportStatusPendingCount){
                        $fail("There has not report");
                    }
                } catch (\Exception $exception) {
                    $fail("This agent is busy on not found");
                }

            }],
        ];
    }
}
