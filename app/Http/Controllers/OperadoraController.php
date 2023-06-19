<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Models\Operadora;

class OperadoraController extends Controller
{

    protected $client;


    public function __construct()
    {

        $this->client = new Client();

    }


    public function obterOperadoras($page = 0, $size = 100)
    {

        $request = $this->client->request('GET',"https://www.ans.gov.br/operadoras-entity/v1/operadoras?page=$page&size=$size&sort=razao_social");

        return json_decode($request->getBody());

    }


    public function obterMaisDadosDaOperadora($url)
    {

        $request = $this->client->request('GET',$url);

        return json_decode($request->getBody());

    }

   
    public function incluirOperadoras()
    {

        set_time_limit(0);
        
        $total_pages = $this->obterOperadoras()->total_pages;
      
        $page = 0; 

        DB::beginTransaction();
        
        try
        {
            while($page <= $total_pages) {

                $operadoras = $this->obterOperadoras($page);

                foreach($operadoras->content as $operadoraDados){

                    
                    $maisDadosDaOperadora = $this->obterMaisDadosDaOperadora($operadoraDados->_links->self->href);
                    
                    $operadora = new Operadora();

                    $operadora->registro_ans                        = (isset($maisDadosDaOperadora->registro_ans) ? $maisDadosDaOperadora->registro_ans : null);
                    $operadora->cnpj                                = (isset($maisDadosDaOperadora->cnpj) ? $maisDadosDaOperadora->cnpj : null);
                    $operadora->razao_social                        = (isset($maisDadosDaOperadora->razao_social) ? $maisDadosDaOperadora->razao_social : null);
                    $operadora->nome_fantasia                       = (isset($maisDadosDaOperadora->nome_fantasia) ? $maisDadosDaOperadora->nome_fantasia : null);
                    $operadora->ativa                               = (isset($maisDadosDaOperadora->ativa) ? $maisDadosDaOperadora->ativa : null);
                    $operadora->email                               = (isset($maisDadosDaOperadora->email) ? $maisDadosDaOperadora->email : null);
                    $operadora->site                                = (isset($maisDadosDaOperadora->site) ? $maisDadosDaOperadora->site : null);
                    $operadora->representante_nome                  = (isset($maisDadosDaOperadora->representante_nome) ? $maisDadosDaOperadora->representante_nome : null);
                    $operadora->representante_cargo                 = (isset($maisDadosDaOperadora->representante_cargo) ? $maisDadosDaOperadora->representante_cargo : null);
                    $operadora->autorizacao_funcionamento_em        = (isset($maisDadosDaOperadora->autorizacao_funcionamento_em) ? $maisDadosDaOperadora->autorizacao_funcionamento_em : null);
                    $operadora->concessao_registro_definitivo_em    = (isset($maisDadosDaOperadora->concessao_registro_definitivo_em) ? $maisDadosDaOperadora->concessao_registro_definitivo_em : null);
                    $operadora->registrada_em                       = (isset($maisDadosDaOperadora->registrada_em) ? $maisDadosDaOperadora->registrada_em : null);
                    $operadora->classificacao_sigla                 = (isset($maisDadosDaOperadora->classificacao_sigla) ? $maisDadosDaOperadora->classificacao_sigla : null);
                    $operadora->classificacao_nome                  = (isset($maisDadosDaOperadora->classificacao_nome) ? $maisDadosDaOperadora->classificacao_nome : null);
                    $operadora->segmentacao_sigla                   = (isset($maisDadosDaOperadora->segmentacao_sigla) ? $maisDadosDaOperadora->segmentacao_sigla : null);
                    $operadora->segmentacao_nome                    = (isset($maisDadosDaOperadora->segmentacao_nome) ? $maisDadosDaOperadora->segmentacao_nome : null);
                    $operadora->endereco_logradouro                 = (isset($maisDadosDaOperadora->endereco_logradouro) ? $maisDadosDaOperadora->endereco_logradouro : null);
                    $operadora->endereco_numero                     = (isset($maisDadosDaOperadora->endereco_numero) ? $maisDadosDaOperadora->endereco_numero : null);
                    $operadora->endereco_complemento                = (isset($maisDadosDaOperadora->endereco_complemento) ? $maisDadosDaOperadora->endereco_complemento : null);
                    $operadora->endereco_bairro                     = (isset($maisDadosDaOperadora->endereco_bairro) ? $maisDadosDaOperadora->endereco_bairro : null);
                    $operadora->endereco_cep                        = (isset($maisDadosDaOperadora->endereco_cep) ? $maisDadosDaOperadora->endereco_cep : null);
                    $operadora->endereco_municipio_codigo           = (isset($maisDadosDaOperadora->endereco_municipio_codigo) ? $maisDadosDaOperadora->endereco_municipio_codigo : null);
                    $operadora->endereco_municipio_nome             = (isset($maisDadosDaOperadora->endereco_municipio_nome) ? $maisDadosDaOperadora->endereco_municipio_nome : null);
                    $operadora->endereco_uf_sigla                   = (isset($maisDadosDaOperadora->endereco_uf_sigla) ? $maisDadosDaOperadora->endereco_uf_sigla : null);
                    $operadora->endereco_valido                     = (isset($maisDadosDaOperadora->endereco_valido) ? $maisDadosDaOperadora->endereco_valido : null);
                    $operadora->telefone_ddd                        = (isset($maisDadosDaOperadora->telefone_ddd) ? $maisDadosDaOperadora->telefone_ddd : null);
                    $operadora->telefone_numero                     = (isset($maisDadosDaOperadora->telefone_numero) ? $maisDadosDaOperadora->telefone_numero : null);
                    $operadora->fax_ddd                             = (isset($maisDadosDaOperadora->fax_ddd) ? $maisDadosDaOperadora->fax_ddd : null);

                    $operadora->save();

                    sleep(1);

                }

                echo $page.'<BR/>';

                $page++;

                sleep(1);

              
            }

            DB::commit();
        
        } 
           catch (Exception $e)
        {

            echo $e->getMessage();
            DB::rollBack();

        }


         echo 'Trazendo as operadoras...';

    }


}
