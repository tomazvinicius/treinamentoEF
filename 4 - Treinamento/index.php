<?php

include_once('./db.php');

$db = new db();

// Testa a conexão com o banco de dados

$db->connect();
while (true) {

    echo "[1] Cadastro \n[2] Movimentação\n[3] Gerar relatório\nInsira: ";
    $selecionarMenu = readline();

    system('clear');

    switch ($selecionarMenu) {
        case 1:
            cadastrar($db);
            break;
        case 2:
            movimentacao($db);
            break;
        case 3:
            gerarRelatorio($db);
            break;
    }

}
function cadastrar($db)
{
    echo "-=-=-=-=-=-=-=-= Cadastrar produto -=-=-=-=-=-=-=-=\n";
    echo "Insira o nome:   ";
    $nome_est = readline();

    echo "Insira a quantidade: ";
    $quantidade_est = readline();


    $db->cadastrar('estoque', ['nome_est' => $nome_est, 'quantidade_est' => $quantidade_est]);

}
function movimentacao($db)
{
    system('clear');
    $db->lerEstoque('estoque');
    echo "Qual é o tipo da transação: \n[0] Entrada [1] Saída\nInsira:";
    $tipotransacao_mov = readline();
    if ($tipotransacao_mov == 1) {

        $tipotransacao_mov = "Saída";
    } else {
        $tipotransacao_mov = "Entrada";
    }

    $today = (date("F j, Y, g:i a"));
    echo "Insira qual item deseja: ";
    $fkItemEstoque_est = readline();

    echo "Insira a quantidade: ";
    $quantidade_mov = readline();
    $venda_mov = 0;

    $db->movimentar('movimentacao', ['tipotransacao_mov' => $tipotransacao_mov, 'data_mov' => $today, 'quantidade_mov' => $quantidade_mov, 'fkItemEstoque_est' => $fkItemEstoque_est], $fkItemEstoque_est);
}

function gerarRelatorio($db)
{
    $db->relatorio();
}