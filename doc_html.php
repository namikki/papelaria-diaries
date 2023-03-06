<?php
    function Monta_Doc_HTML($p_Conteudo){
        $html = "";

        $html .= "<!doctype html> <html>";

        $html .= "<head><meta charset='utf-8'><title>Papelaria Diaries</title></head>";

        $html .= "<body>" . $p_Conteudo . "</body>";

        $html .= "</html>";

        return $html;
    }
?>
