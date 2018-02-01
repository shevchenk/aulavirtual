<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Jorge Salcedo (Shevchenko)">
        <meta name="description" content="Software Aula Virtual ">
    </head>

    <body>
        <h1 colspan='15'>Auditoria de Reprogramaciones de Evaluaciones (Individual)</h1>

        <table border="1">
            <thead>
                <tr style="background-color:#A7C0DC;">
                    <?php
                        for ($i = 0; $i < count($cabecera1); $i++){
                            echo "<th colspan='".$cabecant[$i]."' style='text-align: center;'>".$cabecera1[$i]."</th>";
                        }
                    ?>
                </tr>
                <tr style="background-color:#A7C0DC;">
                   <?php
                        foreach ( $cabecera2 as $cab){
                            echo "<th style='text-align: center;'>".$cab."</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php 
            foreach ( $dataI as $key => $val){
                echo    "<tr>".
                            "<td>".($key+1)."</td>";
                            foreach ( $campos as $ca ){
                                echo "<td>".$val[$ca]."</td>";
                            }
                echo    "</tr>";
            }
            ?>
            </tbody>
        </table>
        
        <h1 colspan='15'>Auditoria de Reprogramaciones de Evaluaciones (Masivo)</h1>

        <table border="1">
            <thead>
                <tr style="background-color:#A7C0DC;">
                    <?php
                        for ($i = 0; $i < count($cabecera1); $i++){
                            echo "<th colspan='".$cabecant[$i]."' style='text-align: center;'>".$cabecera1[$i]."</th>";
                        }
                    ?>
                </tr>
                <tr style="background-color:#A7C0DC;">
                   <?php
                        foreach ( $cabecera2 as $cab){
                            echo "<th style='text-align: center;'>".$cab."</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php 
            foreach ( $dataM as $key => $val){
                echo    "<tr>".
                            "<td>".($key+1)."</td>";
                            foreach ( $campos as $ca ){
                                echo "<td>".$val[$ca]."</td>";
                            }
                echo    "</tr>";
            }
            ?>
            </tbody>
        </table>
        
    </body>
</html>






