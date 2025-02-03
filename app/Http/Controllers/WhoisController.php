<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WhoisController extends Controller
{
    public function index()
    {
        return view('whois');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $domain = $request->search;
        $apiKey = env('WHOISJSON_API_KEY');

        $curl = curl_init();
        $headers = [];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://whoisjson.com/api/v1/whois?domain=" . urlencode($domain),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Token={$apiKey}"
                //"Authorization: Token=1234"
            ],

            CURLOPT_HEADERFUNCTION => function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) === 2) {
                    $headers[trim($header[0])] = trim($header[1]);
                }
                return $len;
            }
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $remainingRequests = $headers['Remaining-Requests'] ?? 'Desconhecido';

        curl_close($curl);

        switch ($httpCode) {
            case 200:
                $data = json_decode($response, true);
                $domainRecord = "";

                if (isset($data['status']) && $data['status'] === 'fail') {
                    session()->flash('error', $data['message'] ?? 'Erro ao buscar informações do domínio.');
                }
                else
                {
                    session()->forget('error');

                    if (isset($data['nameserver']) && is_array($data['nameserver'])) {
                        $data['nameserver'] = implode(', ', $data['nameserver']);
                    }
                    if (isset($data['expires'])) {
                        $data['expires'] = Carbon::parse($data['expires'])->format('Y-m-d');
                    }
                    $domainRecord = Domain::where('domain', $domain)->first();
                }

                return
                    view(
                        'whois',
                        compact( 'data', 'response', 'domainRecord', 'remainingRequests')
                    );
            case 400:
                return back()->with('error', 'Erro 400: Requisição inválida.');
            case 401:
                return back()->with('error', 'Erro 401: Token de acesso inválido.');
            case 403:
                return back()->with('error', 'Erro 403: Acesso negado. Verifique se seu e-mail está validado.');
            case 429:
                return back()->with('error', 'Erro 429: Limite de requisições excedido.');
            case 500:
                return back()->with('error', 'Erro 500: Erro interno no servidor da API.');
            default:
                return back()->with('error', "Erro desconhecido ({$httpCode}). Tente novamente mais tarde.");
        }
    }
}