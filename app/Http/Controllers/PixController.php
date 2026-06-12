<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use Throwable;

class PixController extends Controller
{
    public function gerar(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

        $client = new PaymentClient();

        try {
            $payment = $client->create([
                'transaction_amount' => (float) $request->amount,
                'description'        => 'Encanto Pet - Pedido',
                'payment_method_id'  => 'pix',
                'payer'              => [
                    'email' => $request->user()->email,
                ],
            ]);

            $data = $payment->point_of_interaction->transaction_data;

            return response()->json([
                'qr_code'        => $data->qr_code,
                'qr_code_base64' => $data->qr_code_base64,
                'payment_id'     => $payment->id,
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Não foi possível gerar o Pix. Tente novamente.'], 500);
        }
    }
}
