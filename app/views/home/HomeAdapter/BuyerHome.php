<?php
    class BuyerHome {
        public function showBuyerHome() {
            echo "<p><a href='/GerenciaUsuario/public/list'>Visualizar vendedores</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/buy-product'>Comprar produtos</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/edit'>Editar meu Perfil</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/delete'>Excluir minha Conta</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/logout'>Logout</a></p>";
        }
    }
    
?>