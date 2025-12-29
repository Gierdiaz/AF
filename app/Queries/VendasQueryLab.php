<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class VendasQueryLab
{
    public function pedidosPorCliente()
    {
        $query = DB::table('clientes')
            ->select([
                'clientes.nome as cliente',
                'pedidos.total as total_pedido',
            ])
            ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
            ->orderBy('pedidos.total', 'DESC');

        dd($query->toSql(), $query->getBindings());
    }

    public function quantidadePedidosPorCliente()
    {
        $query = DB::table('clientes')
            ->select([
                'clientes.nome as cliente',
                DB::raw('COUNT(pedidos.id) as total_pedidos')
            ])
            // ou nesse select poderia usar o selectRaw passando apenas o COUNT
            ->join('pedidos', 'clientes.id', '=', 'pedidos.id')
            ->groupBy('clientes.nome')
            ->orderBy('total_pedidos', 'DESC');
        
            dd($query->toSql(), $query->getBindings());

        // Sempre que for trabalhar com COUNT, SUM, AVG, MAX, MIN usar DB::raw
    }

    // Nível 1 - Select básico

    public function listarClientes()
    {
       return DB::table('clientes')
            ->select('nome')->get();
    }

    public function listarContatoNomeCliente()
    {
        return DB::table('clientes')
            ->select([
                'cliente.nome',
                'cliente.contato'
            ])
            ->get();
    }

    public function listarProdutos()
    {
        return DB::table('produtos')
            ->select([
                'produtos.nome',
                'produtos.preco'
            ])
            ->get();

    }

    public function listarCategorias()
    {
        return DB::table('categorias')
            ->select('categorias.nome')
            ->get();
    }

    public function listarPedidoIdeTotal()
    {
        return DB::table('pedidos')
            ->select([
                'pedidos.id',
                'pedidos.total'
            ])
            ->get();
    }

    public function listarPagamentos()
    {
        return DB::table('pagamentos')
            ->select([
                'pagamentos.metodo',
                'pagamentos.quantidade as valor'
            ])
            ->get();
    }

    public function listarUsuarios()
    {
        return DB::table('users')
            ->select([
                'users.name',
                'users.email'
            ])
            ->get();
    }

    public function listarProdutosDESC()
    {
        return DB::table('produtos')
            ->select([
                'produtos.*'
            ])
            ->groupBy('produtos.preco', 'DESC')
            ->get();
    }

    public function listarProdutosASC()
    {
        return DB::table('produtos')
            ->select([
                'produtos.*'
            ])
            ->groupBy('produtos.preco', 'ASC')
            ->get();
    }

    public function listarClientesPorNome()
    {
        return DB::table('clientes')
            ->orderBy('clientes.nome', 'ASC')
            ->get();
    }

    // Nível 2 - WHERE /FILTERS

    public function listarProdutosMaior100()
    {
        return DB::table('produtos')
            ->select([
                'produtos.preco'
            ])
            ->where('produtos.preco', '>', 100)
            ->get();
    }

    public function listarProdutosMaior50Menor200()
    {
        return DB::table('produtos')
            ->select('produtos.preco')
            ->where('produtos.preco', '>', 50, 'and', 'produtos.preco', '<', 200)
            ->get();
    }

    public function listarPedidosTotalMaior500()
    {
        return DB::table('pedidos')
            ->select(['pedidos.total'])
            ->where('pedidos.total', '>', 500)
            ->get();
    }

    public function listarClientesNomeA()
    {
        return DB::table('clientes')
            ->select('clientes.nome')
            ->where('clientes.nome', 'LIKE', 'A%')
            ->get();
    }

    public function listarProdutosNomeContemPro()
    {
        return DB::table('produtos')
            ->select('produtos.nome')
            ->where('produtos.nome', 'LIKE', '%Pro%')
            ->get();
    }

    public function listarPedidosClienteEspecifico()
    {
        return DB::table('pedidos')
            ->select(['pedidos.*'])
            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->where('clientes.id', '=', 1)
            ->get();
    }

    public function listarPedidosUsuarioEspecifico()
    {
        return DB::table('pedidos')
            ->select('pedidos.*')
            ->join('users', 'users.id', '=', 'pedidos.user_id')
            ->where('users.email', '=', 'gierdiaz@hotmail.com')
            ->get();
    }

    public function listarPagamentoValorMaior300()
    {
        return DB::table('pagamentos')
            ->select('pagamentos.quantidade')
            ->where('pagamentos.quantidade', '>', 300)
            ->get();
    }

    public function listarPedidosCriadosHoje()
    {
        return DB::table('pedidos')
            ->select('pedidos.*')
            ->whereBetween('pedidos.created_at', [
                '2025-12-28 00:00:00',
                '2025-12-28 23:59:59'
            ])
            ->get();
    }

    // Nível 3 - Join simpls
    
    public function listarPedidosClientes()
    {
        return DB::table('pedidos')
            ->select('pedidos.id', 'clientes.nome')
            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->get();
    }

    public function listarPedidosUsuarios()
    {
        return DB::table('pedidos')
            ->select(['pedidos.id', 'users.name'])
            ->join('users', 'users.id', '=', 'pedidos.user_id')
            ->get();
    }

    public function listarPedidosCategoria()
    {
        return DB::table('produtos')
            ->select(['produtos.id', 'categorias.nome'])
            ->join('categorias', 'categorias.id', '=', 'produtos.id')
            ->get();
    }

    public function listarItensPedidoNomeProduto()
    {
        return DB::table('pedido_itens')
            ->select(['pedido_itens.id', 'produtos.nome'])
            ->join('produtos', 'produtos.id', '=', 'pedido_itens.produto_id')
            ->get();
    }

    public function listarPagamentosTotalPedido()
    {
        return DB::table('pagamentos')
            ->select(['pagamentos.id', 'pedidos.total'])
            ->join('pedidos', 'pagamentos.pedido_id', 'pedidos.id')
            ->get();
    }

    public function listarItensPedidoPrecoUnitario()
    {
        return DB::table('pedido_itens')
            ->select(['pedido_itens.id', 'pedido_itens.preco'])
            ->get();
    }

    public function listarPedidosNomeCliente()
    {
        return DB::table('pedidos')
            ->select(['pedidos.id', 'clientes.nome'])
            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->orderBy('clientes.nome')
            ->get();
    }

    // Nível - 4 Join múltiplo

    public function listarPedidosClientesUsariosETotal()
    {
        return DB::table('pedidos')
            ->select(['clientes.nome', 'users.name', 'pedidos.total'])
            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->join('users', 'users.id', '=', 'pedidos.user_id')
            ->get();
    }

    public function listarItensPedidoProdutoCategoria()
    {
        return DB::table('pedido_itens')
            ->select([
                'pedido_itens.id as pedido_id', 
                'produtos.nome as produto_name', 
                'categorias.nome as categorias_name'
            ])
            ->join('produtos', 'produtos.id', '=', 'pedido_itens.produto_id')
            ->join('categorias', 'categorias.id', '=', 'produtos.categoria_id')
            ->get();

    }

    public function listarPedidosClienteProdutoQuantidade()
    {
        return DB::table('pedidos')
            ->select([
                'pedidos.id as pedido',
                'clientes.nome as cliente',
                'produtos.nome as produto',
                'pedido_itens.quantidade as quantidade'
            ])
            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->join('produtos', 'produtos.id', '=', 'pedido_itens.produto_id')
            ->join('pedido_itens', 'pedido_itens.pedido_id', '=', 'pedidos.id')
            ->get();
    }

    public function listarPedidosClientesMetodoPagamento()
    {
        return DB::table('pedidos')
            ->select([
                'pedidos.id as pedidos',
                'clientes.nome as cliente',
                'pagamentos.metodo as metodo'
            ])
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->join('pagamentos', 'pagamentos.pedido_id', 'pedidos.id')
            ->get();
    }

    public function listarProdutosVendidosNomeCliente()
    {
        return DB::table('produtos')
            ->select([
                'produtos.nome as produto',
                'clientes.nome as cliente'
            ])
            ->join('pedido_itens', 'pedido_itens.produto_id', '=', 'produtos.id')
            ->join('pedidos', 'pedidos.id', '=', 'pedido_itens.pedido_id')
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->get();
    }

    public function listarPedidosTodosProdutos()
    {
        return DB::table('pedidos')
            ->select([
                'pedidos.id as pedido',
                'produtos.nome as produto'
            ])
            ->join('pedido_itens', 'pedido_itens.pedido_id', '=', 'pedidos.id')
            ->join('produtos', 'pedido_itens.produto_id', '=', 'produtos.id')
            ->get();
    }

    public function listarClientesRealizaramPedidos()
    {
        return DB::table('clientes')
            ->select([
                'clientes.nome as cliente',
                'pedidos.id as pedido'
            ])
            ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
            ->get();
    }

    public function listarUsuariosVenderamPedidos()
    {
        return DB::table('users')
            ->select([
                'users.id as usuario_id',
                'users.name as usuario'
            ])
            ->join('pedidos', 'pedidos.user_id', '=', 'users.id')
            ->distinct()
            ->get();
    }
}