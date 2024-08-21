<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class AppointmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>[
                'required',
                'string'
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:10:00',
                'before:19:00',
                function ($attribute, $value, $fail) {
                    $validTimes = [
                        '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
                        '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
                        '16:00', '16:30', '17:00', '17:30', '18:00', '18:30'
                    ];

                    if (!in_array($value, $validTimes)) {
                        $fail('Siz yalnız 30 dəqiqəlik artımlarla vaxt intervalı seçə bilərsiniz');
                    }

                    $existing = Appointment::where('date', $this->date)
                        ->where('time', $value)
                        ->first();

                    if ($existing) {
                        $fail('Bu vaxt artıq başqa istifadəçi tərəfindən götürülüb');
                    }
                },
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            Log::info('withValidator called.');
            $now = Carbon::now();
            $selectedDateTime = Carbon::parse($this->date . ' ' . $this->time);

            if ($selectedDateTime->lt($now)) {
                $validator->errors()->add('time', 'Keçmiş zamanı seçə bilməzsiniz');
            }
        });
    }
    public function messages():array
    {
        return  [
            'name.required'=>'Ad sahəsi tələb olunur',
            'date.required'=>'Tarix sahəsi tələb olunur',
            'date.after_or_equal'=>'Tarix bu gün və ya gələcək zaman seçmılisiniz',
            'time.required'=>'Vaxt sahəsi tələb olunur',
            'time.after_or_equal'=>'Yalnız saat 10 və sonra seşə bilərsiniz',
            'time.before'=>'Saat 19 əvvəl seşə bilərsiniz'
        ];
    }
}
