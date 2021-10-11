<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border:1px solid black;
        }
        td{
            border:1px solid black;
            size: 4rem;
        }
    </style>
</head>

<body>

<?php
        $posicionBorrada=0;
        $filas=[];

        //borramos las posiciones de las columnas
        for($i=0; $i<9 ;$i++){
            $column=generarColumna($i);

            if($i==0){
                $posicionBorrada=rand(0,2);
                $column[$posicionBorrada]=0;
            }else{
                $posicionBorrada+=rand(1,2);
                switch($posicionBorrada){
                    case 0:
                    case 3:
                        $posicionBorrada=0;
                        $column[$posicionBorrada]=0;
                        break;
                    case 1: 
                    case 4:
                        $posicionBorrada=1;
                        $column[$posicionBorrada]=0;
                        break;
                    case 2:
                        $posicionBorrada=2;
                        $column[$posicionBorrada]=0;
                        break;
                }
            }
            array_push($filas,$column);
        }

        $soloUnaPosicion=generarNumeroAleatorioFila($filas);
        foreach($soloUnaPosicion as $posicion){
            $filas[$posicion[1]][$posicion[0]]=0;

        }

        pintarTabla($filas);




        //FUNCIONES: 
        function generarNumeroAleatorioFila($filas){
            $filaColumna=[];
            $fila1=0;
            $fila2=0;
            $fila3=0;
            for($fila=0;$fila<3;$fila++){
                for($columna=0;$columna<9;$columna++){
                    if($filas[$columna][$fila]==0){
                    switch($fila){
                        case 0:
                            $fila1++;
                        break;
                        case 1:
                            $fila2++;
                        break;
                        case 2:
                            $fila3++;
                        break;
                    }
                    }
                }
            }
            $fila1=4-$fila1;
            $fila2=4-$fila2;
            $fila3=4-$fila1;

            for($contador=3 ; $contador>0; $contador--){
                $fila;
                if($fila1>0){
                    $fila=0;
                    $fila1--;
                }else {
                    if($fila2>0){
                        $fila=1;
                        $fila2--;
                    }else{
                        $fila=2;
                        $fila3--;
                    }
                }

                $filaColumnaAux=[];
                $repetido=true;
                
                do{
                    $numero= rand(0,8);
                    if($filas[$numero][$fila]!=0 && noRepetido($filaColumna, $fila,$numero) ){
                        $repetido=false;
                        array_push($filaColumnaAux,$fila);
                        array_push($filaColumnaAux,$numero);
                    }
                }while($repetido);
               array_push($filaColumna, $filaColumnaAux);   
            }
            return  $filaColumna;
        }

        function noRepetido($filaColumnaAux, $fila,$numero){
            foreach($filaColumnaAux as $columna){
                if($columna[1] == $numero){
                    return false;
                }
            }
            return true;
        }

        function pintarTabla($filas){
            echo "<table>";      
                    for($i=count($filas[0])-1; $i>=0;$i--){
                        echo "<tr>";

                        for($o=0; $o<count($filas); $o++){
                            if($filas[$o][$i]!=0){
                                    echo "<td>".$filas[$o][$i]."</td>";

                            }else{
                                echo "<td></td>";
                            }
                        }
                        echo "</tr>";
                    }
            echo "</table>";      
        }
        
        function generarColumna($startRange){
            $column=[];
            for($i=0; $i<3 ;$i++){
                array_push($column, generarNumeroAleatorio($column, $startRange));
            }
            sort($column);
            return $column;
        }
        
        function generarNumeroAleatorio($column, $startRange){
            $exist=true;
            $number=99999;
            do{
            $number=rand(($startRange*10>0) ? $startRange*10 : 1 ,$startRange*10+9);
                if(!in_array($number,$column)){
                    $exist=false;
                }
            }while($exist);
            return $number;
        }
    ?>
</body>
</html>