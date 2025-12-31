<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function orderInvoice(Order $order)
    {
        dd('masuk sini');
        $order->load('items');

        $pdf = Pdf::loadView('invoices.order', compact('order'));

        $fileName = 'invoice-'.$order->id.'.pdf';

        \Storage::disk('public')->makeDirectory('invoices');

        \Storage::disk('public')->put('invoices/'.$fileName, $pdf->output());

        return 'saved';
    }

    public function sendInvoiceToWhatsapp(Order $order)
    {
        $order->load('items');

        $pdf = Pdf::loadView('invoices.order', compact('order'));

        $fileName = 'invoice-'.$order->id.'.pdf';

        \Storage::disk('public')->makeDirectory('invoices');

        \Storage::disk('public')->put('invoices/'.$fileName, $pdf->output());

        $pdfUrl = asset('storage/invoices/'.$fileName);

        $phone = preg_replace('/[^0-9]/', '', $order->customer_phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        }

        $message = urlencode("Halo {$order->customer_name}, berikut invoice Anda, Terima kasih\n\n{$pdfUrl}");

        return redirect()->away("https://wa.me/{$phone}?text={$message}");
    }
}
