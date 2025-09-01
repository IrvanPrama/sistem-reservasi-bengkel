<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Reservation;
use App\Models\Lapangan;
use Carbon\Carbon;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

   protected function mutateFormDataBeforeCreate(array $data): array
{
    // Cek overlap
    $isOverlap = Reservation::where('field_id', $data['field_id'])
        ->whereDate('date', $data['date']) 
        ->where(function($query) use ($data) {
            $query->where('start_time', '<', $data['end_time'])
                  ->where('end_time', '>', $data['start_time']);
        })
        ->exists();

    if ($isOverlap) {
        $this->addError('start_time', 'Jadwal sudah terpakai, silakan pilih jam lain.');
        $this->halt(); // stop proses create
    }

    // Hitung total biaya
    $start = Carbon::parse($data['start_time']);
    $end   = Carbon::parse($data['end_time']);
    $durationInHours = $start->diffInMinutes($end) / 60;

    $field = Lapangan::findOrFail($data['field_id']);
    $pricePerHour = $field->price_per_hour;

    $total = $durationInHours * $pricePerHour;

    // minimal harga per jam
    if ($total < $pricePerHour) {
        $total = $pricePerHour;
    }

    // bulatkan ke atas kelipatan 50.000
    $data['total_amount'] = ceil($total / 50000) * 50000;

    return $data;
}

}
