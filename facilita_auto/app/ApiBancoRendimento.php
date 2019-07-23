<?php

namespace App;

use GuzzleHttp\Client;
use Carbon\Carbon;
use Hamcrest\Type\IsArray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ApiBancoRendimento extends Model
{
    private $TOKEN;
    private $URL_ENDPOINT;
    private $URL_TOKEN_API;
    
    public function __construct()
    {
        $this->ConfiguracoesAPI();
    }
   
    public function ConfiguracoesAPI(){
        $credenciais = Credencial::where('nome', env('APP_AMBIENTE','desenvolvimento'))->first();
        $clientId = $credenciais->ClientID;
        $secret = $credenciais->ClientSecret;
        $this->URL_ENDPOINT = $credenciais->Endpoint;
        $this->URL_TOKEN_API = $credenciais->UrlAutenticacao;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $this->URL_TOKEN_API, [
                'headers' =>
                    [
                        'Accept' => 'application/json',
                        'Accept-Language' => 'en_US',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                'body' => 'grant_type=client_credentials',

                'auth' => [$clientId, $secret, 'basic']
            ]
        );
        $data = json_decode($response->getBody(), true);
        $this->TOKEN = (string) $data['access_token'];
        session()->put('token_key',  $this->TOKEN);
        //return $token;
        //dd($data);
        //dd([$credenciais,$data]);
    }

    public function requisicaoCEPViaCep($cep){
        $curl = curl_init();

        $arrayCurl = [
            CURLOPT_URL => "https://viacep.com.br/ws/".$cep."/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ];
        if(isset($cep)){
            //$arrayCurl[CURLOPT_POSTFIELDS] = (['code' => $cep ]);
            //dd($arrayCurl[CURLOPT_POSTFIELDS]);
        }

        curl_setopt_array($curl, $arrayCurl);
        $response = curl_exec($curl);

        //dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }

        return [
            'erro' => $err,
            'response' => $response,
            
        ];

    }
   

    public function requisicaoCEP($cep){
        $curl = curl_init();

        $arrayCurl = [
            CURLOPT_URL => 'https://apps.widenet.com.br/busca-cep/api/cep.json?code='.$cep,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ];
        if(isset($cep)){
            $arrayCurl[CURLOPT_POSTFIELDS] = (['code' => $cep ]);
            //dd($arrayCurl[CURLOPT_POSTFIELDS]);
        }

        curl_setopt_array($curl, $arrayCurl);
        $response = curl_exec($curl);

        //dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }

        return [
            'erro' => $err,
            'response' => $response,
            
        ];

    }

    private function requisicao($url, $typeMethod, $postFields=null){
        $curl = curl_init();

        $arrayCurl = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $typeMethod,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$this->TOKEN."",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ];
        if(isset($postFields)){
            $arrayCurl[CURLOPT_POSTFIELDS] = $postFields;
            //dd($arrayCurl[CURLOPT_POSTFIELDS]);
        }

        $strcurl = curl_setopt_array($curl, $arrayCurl);
        
        $response = curl_exec($curl);

        //dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }

        return [
            'erro' => $err,
            'response' => $response,
            
        ];

    }

    /***********************************************DOMINIOS**********************************************************/
        //Bancos
        public function consultaBancos(){
            //https://c2gvw4lxh9.execute-api.sa-east-1.amazonaws.com/hmg/api/v1/ep
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/dominios/bancos",'GET');
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response']['retorno'];
            else
                return null;
        }

        //Categorias de documentos 
        // $categoria = FOTO, DOCUMENTO_IDENTIFICACAO, COMPROVANTE_RENDA, COMPROVANTE_RESIDENCIA, CCB, KIT_PROBATORIO
        public function consultaCategoriasDocumentos($categoria){
            if(!isset($categoria)) 
                return null;
            
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/dominios/categoriasdocumentos/".$categoria,'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response']['retorno'];
            else
                return null;
        }

        //Motivos de Cancelamento
        public function consultaMotivosCancelamento(){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/dominios/motivoscancelamento",'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response']['retorno'];
            else
                return null;
            
        }
    /*********************************************** FIM DOMINIOS*****************************************************/


    /***********************************************POS MESA**********************************************************/
        //Lista propostas pendentes de analise
        public function consultaPropostasPendentes(){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/dominios/bancos",'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response']['retorno'];
            else
                return null;
        }

        
    /*********************************************** FIM POS MESA**********************************************************/

    /***********************************************PRODUTOS**********************************************************/
        //Lista propostas pendentes de analise
        public function consultaProdutos(){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/produtos",'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response']['retorno'];
            else
                return null;
        }        
    /*********************************************** FIM PRODUTOS**********************************************************/

    /***********************************************SIMULADORES**********************************************************/
        //Realiza uma simulação de plano de pagamento de EP
        public function simularPlano($valor=1000, $parcela=6, $taxa='2.97',$tarifaCadastro='2.97'){
            
            $fields = [
                "valorSolicitado" => number_format($valor, 2, '.', ''),
                "qteParcelas" => [$parcela],
                "taxaJurosMensal" => $taxa,
                "dataPrimeiraParcela" =>  date('Y-m-d',strtotime("+30 days")) ,
                "tarifaCadastro" => $tarifaCadastro
            ];

            $url = "{$this->URL_ENDPOINT}/api/v1/ep/simuladores";
            $requisicao = $this->requisicao($url,'POST',json_encode($fields));

            //dd([$requisicao,$url,$fields]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno']['planosPgamento'][0];
                }
            else
                return null;
        }        
    /*********************************************** FIM SIMULADORES**********************************************************/

    /***********************************************VALIDADORES**********************************************************/
        //Realiza uma simulação de plano de pagamento de EP
        public function validarDadosBancarios($codigoBanco, $numeroAgencia, $numeroConta, $digitoConta,$tipoConta){
            
            $fields = [
                "codigoBanco"=> $codigoBanco,
                "numeroAgencia"=> $numeroAgencia,
                "numeroConta"=> $numeroConta,
                "digitoConta"=> $digitoConta,
                "tipoConta"=> $tipoConta
            ];
            
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/validadores/dadosbancarios",'POST',json_encode($fields));

            //dd($requisicao);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }        
    /*********************************************** FIM VALIDADORES**********************************************************/

    /***********************************************PROPOSTAS**********************************************************/
        //Retornar Limites disponiveis para o cliente
        public function consultarLimites($nro_proposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$nro_proposta}/limites",'GET');
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //Busca o resultado de operações assíncronas em lote
        public function consultarStatusProposta($nro_proposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/status?numerosPropostas={$nro_proposta}",'GET');
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return isset($requisicao['response']['retorno']['listaSituacaoPropostas'][0]['statusProposta']) ? $requisicao['response']['retorno']['listaSituacaoPropostas'][0]['statusProposta'] : null;
                }
            else
                return null;
        }
        
        //Insere nova proposta
        public function novaProposta($fields,$callback_url){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas?callbackUrl={$callback_url}",'POST',json_encode($fields));

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;

        }

        //Busca as pendências das propostas em lote
        public function propostaPendencias($nro_proposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/pendencias?numerosPropostas={$nro_proposta}",'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //Retorna proposta completa
        public function propostaCompleta($nro_proposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$nro_proposta}",'GET');
            //dd($requisicao);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //Realiza o cancelamento de uma proposta
        public function cancelaProposta($nro_proposta, $codigoMotivoCancelamento){
            $field = [$codigoMotivoCancelamento];
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas?numerosPropostas={$nro_proposta}",'DELETE',$field);

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //Solicita a análise cadastral do usuário. 
        //Em relação a versão anterior foram adicionadas as necessidades de enviar o valor de patrimônio e as informações de endereço comercial.
        public function solicitaAnaliseCadastral($nro_proposta,$callback_url,$fields){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v2/ep/propostas/{$nro_proposta}/analisecadastral?callbackUrl={$callback_url}",'PUT',json_encode($fields));
            //dd($requisicao);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                return $requisicao['response'];
                /*if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }*/
            else
                return null;
        }

        //
        //Calcula o plano de pagamento para determinada prosposta de cálculo de EP
        public function calculaPlanoPgto($numeroProposta,$valorPrincipal,$dataPrimeiraParcela){
            $fields = [
                "valorPrincipal" => $valorPrincipal,
                "dataPrimeiraParcela" => $dataPrimeiraParcela
            ];
            
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/calculadora",'POST',json_encode($fields));
            //dd(['calculaPlanoPgto',$fields,$requisicao]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //Define as condições financeiras escolhidas pelo cliente. E especifica os dados bancários para a liberação do empréstimo
        public function inserirEspecificacaoFinanceira($numeroProposta,$fields){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/especificacaofinanceira",'PUT',json_encode($fields));

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //
        //Realiza a validação de limites
        public function validarLimites($numeroProposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/validacaolimites",'PUT');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response'];
                }
            else
                return null;
        }

        //Solicita analise ddocumental
        public function solicitaAnaliseDocumental($numeroProposta, $callback_url=null){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/analisedocumental?callbackUrl={$callback_url}",'PUT');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response'];
                }
            else
                return null;
        }

        //Solicita Formalizacao
        public function solicitaFormalizacao($numeroProposta, $callback_url=null){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/formalizacao?callbackUrl={$callback_url}",'PUT');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response'];
                }
            else
                return null;
        }


        //Retorna o pdf do contrato
        public function documentosFormalizacao($numeroProposta){
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/documentosformalizacao",'GET');

            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response']['erros'][0]['tipo'].' - '.$requisicao['response']['erros'][0]['mensagem'];
                }else{
                    return $requisicao['response'];
                }
            else
                return null;
        }


        public function inserirDocumentos($numeroProposta, $fields){
            
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/documentos",'POST',json_encode($fields));
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        //inclui o kit probatorio na proposta
        public function inserirKitProbatorio($numeroProposta){
            $kit = KitProbatorio::where('nr_pedido', $numeroProposta)->first();
            
            $fields = [
                "dataAceiteEmprestimo"=> $kit->dataAceiteEmprestimo,
                "tipoDipositivoCliente"=> $kit->tipoDipositivoCliente,
                "modeloDipositivoCliente"=> $kit->modeloDipositivoCliente,
                "navegadorCliente"=> $kit->navegadorCliente,
                "ipCliente"=> $kit->ipCliente,
                "portaLogicaAplicacao"=> $kit->portaLogicaAplicacao,
                "latitudeCliente"=> substr($kit->latitudeCliente,0,8),
                "longitudeCliente"=> substr($kit->longitudeCliente,0,8),
                "observacaoAceite"=> $kit->observacaoAceite
            ];
            //dd($fields);           
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/kitprobatorio",'POST',json_encode($fields));
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response'];
                }
            else
                return null;
        }



    /*********************************************** FIM PROPOSTAS**********************************************************/

    /*********************************************** CONTRATOS **************************************************************/
        public function getBoletos($numeroProposta){
                
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/contratos/{$numeroProposta}/boletos",'GET');
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        public function getBoletos2via($numeroProposta, $arrayParcelas){
                
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/contratos/{$numeroProposta}/boletos/parcelas",'GET',json_encode($arrayParcelas));
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        public function getBoleto2via($numeroProposta, $numeroParcela){
                
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/contratos/{$numeroProposta}/boletos/{$numeroParcela}",'GET');
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

        public function getDocumentosFormalizacao($numeroProposta){
                
            $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/contratos/{$numeroProposta}/documentosformalizacao",'GET');
            //dd([$fields,$requisicao,$numeroProposta]);
            if(isset($requisicao['erro']) && empty($requisicao['erro']))
                if(!empty($requisicao['response']['erros'])){
                    return $requisicao['response'];
                }else{
                    return $requisicao['response']['retorno'];
                }
            else
                return null;
        }

    /*********************************************** FIM CONTRATOS **********************************************************/

    public function getTimeline($numeroProposta){
                
        $requisicao = $this->requisicao("{$this->URL_ENDPOINT}/api/v1/ep/propostas/{$numeroProposta}/timeline",'GET');
        //dd([$fields,$requisicao,$numeroProposta]);
        if(isset($requisicao['erro']) && empty($requisicao['erro']))
            if(!empty($requisicao['response']['erros'])){
                return $requisicao['response'];
            }else{
                return $requisicao['response'];
            }
        else
            return null;
    }



    public function status($retorno){
            if($retorno == "REALIZANDO_ANALISE_PREVIA")
               return  $this->REALIZANDO_ANALISE_PREVIA();
            
            if($retorno == "ANALISE_PREVIA_CONCLUIDA")
               return $this->ANALISE_PREVIA_CONCLUIDA();
            
            if($retorno == "REALIZANDO_ANALISE_CADASTRAL")
               return  $this->REALIZANDO_ANALISE_CADASTRAL();
            

            if($retorno == "ANALISE_CADASTRAL_CONCLUIDA")
               return  $this->ANALISE_CADASTRAL_CONCLUIDA();
            

            if($retorno == "REPROVADA")
                return  $this->REPROVADA();

            if($retorno == "REALIZANDO_ANALISE_DOCUMENTAL")
               return $retorno;
            
            if($retorno == "FORMALIZANDO_PROPOSTA")
                return $retorno;
    
            if($retorno == "ANALISE_DOCUMENTAL_CONCLUIDA"){
                return $retorno;
            }

            if($retorno == "APROVADA")
                return $retorno;
            
            if($retorno == "PENDENCIADA")
                return 'Sua proposta foi pendenciada, falta criar metodo';
    }

    public function InserirDocumentos2($request, $proposta){
        $data_cadastro                  =       $proposta;
        $data_documentos                =       DB::table('documentos')->where('id_cadastro',  $data_cadastro->id)->first();
        $data_bancarios                 =       DB::table('dados_bancarios')->where('id_cadastro',  $data_cadastro->id)->first();

        $image                          =       base64_encode(file_get_contents($request->file('image')));

        $requisicao = $this->requisicao(
            "{$this->URL_ENDPOINT}/propostas/".$data_bancarios->nr_pedido."/documentos",
            'POST',
            "{
                \"arquivo\": \"".$image."\",
                \"extensaoArquivo\": \"".strtoupper($request->file('image')->extension())."\",
                \"nomeArquivo\": \"".$request->file('image')->getClientOriginalName()."\",
                \"tipoDocumento\": \"".$request->tipodoc."\"
                }"
        );


        /** [ FOTO, RG, CARTEIRA_CONSELHO_ORDEM, PASSAPORTE, CNH, RNE, EXTRATO_BANCARIO, HOLERITE_GRANDE_PORTE, EXTRATO_FGTS, EXTRATO_INSS, COMPROVANTE_SAQUE_INSS, EXTRATO_CONTA_COM_INSS, RECIBO_DECLARACAO_IR, PROLABORE, DECORE_ANUAL, CONTA_LUZ, CONTRATO, KIT_PROBATORIO ]]*/
        
        $response = $requisicao['response'];

        return $response;

    }

        public function InserirProposta($proposta_id){
            $simulacao = new EmprestimoController();
            $token = $simulacao->ConfiguracoesAPI();

            $client =   new Client([
                'base_uri' => $this->URL_TOKEN_API,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $getDataEmprestimoById = new EmprestimoController();


            $data = $getDataEmprestimoById->getDataEmprestimoById($proposta_id);


            $pontos = array(',','.','-');
            $cpf = str_replace( $pontos,   "",  Auth::user()->cpf);


            $salario = str_replace('.', '', $data->salario);
            $salario = str_replace(',', '.', $salario);

                
            $retorno01  =  $client->request('POST', $this->URL_ENDPOINT. '/api/v1/ep/propostas',
                [
                    \GuzzleHttp\RequestOptions::JSON => ["nome" => $data->nome_completo,
    //                    "qteParcelas" => [
    //                        $request->qteParcelas,
    //                    ],
                        "cpf" => $cpf,
                        "dataNascimento" =>  $getDataEmprestimoById->ReplaceData($data->dt_nasc) ,
                        "naturezaOcupacao" => $data->ocupacao,
                        "genero" => strtoupper($data->sexo),
                        "rendaMensal" => $salario,
                        "uf" => strtoupper($data->uf_res)
                    ]
                ]);


            $arr = json_decode($retorno01->getBody());

//            return $arr;

            try {
                $dados_bancarios                = new DadosBancarios();
                $dados_bancarios->nr_pedido     = $arr->retorno->numeroProposta;
                $dados_bancarios->nro_proc_bco  = $arr->retorno->identificadorOperacao;
                $dados_bancarios->id_cadastro   = $id;
                $dados_bancarios->save();
            }

            catch(\Exception $e){
                // do task when error
                echo $e->getMessage();   // insert query
            }



            $data_email['nome'] = $data->nome_completo;


            $dataP = DB::table('pre_cadastro')->where('email',  $data->email)->first();
//
//
            $user = PreCadastro::find($dataP->id)->toArray();



            Mail::send('emails.pre_analise', $user, function($message) use ($user) {

                $message->to($data->email);
                $message->subject('Proposta de Pré Analise da Facilita Credito Pessoal');

            });


            return $arr;
        }

        private function postFields($array = null)
        {
            if (! isset($array) or empty($array))
                return '';

            $retorno = [];
            foreach ($array as $campo => $valor) {
                if(is_array($valor)){
                    $retorno[] = $campo . "=" .$this->postFields($valor);
                }else{
                    $retorno[] = $campo . "=" . $valor;
                }
            }

            return implode('&', $retorno);
        }

}
