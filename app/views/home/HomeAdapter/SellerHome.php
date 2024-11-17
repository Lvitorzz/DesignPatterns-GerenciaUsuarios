<?php
    class SellerHome {
        public function showSellerHome() {
            echo "<p><a href='/GerenciaUsuario/public/list'>Visualizar compradores</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/painel'>Visualizar Painel</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/edit'>Editar meu Perfil</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/delete'>Excluir minha Conta</a></p>";
            echo "<p><a href='/GerenciaUsuario/public/logout'>Logout</a></p>";
        }
    }
?>