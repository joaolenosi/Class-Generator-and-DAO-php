<?php
/**
 * Description: this file is responsible for generating the DAO according to the structure of the database table.
 * Date          : 15-02-2021;   
 * Author        : João Leno
 * 1 - Campos    : Nome de todas as colunas da tabela
 * 2 - Tabela    : Nome da tabela
 * 3 - ID        : Chavé primária da tabela
 */
echo " <br><br>";
$campos = array('idsecaolog','idquadra','numero','ocupacao','situacao','topografia','pedologia','posicao','uso','formaaquisicao	','fecho','testada','codparcela','drenagem','geo','latlong','URL','status','fotografia','geocodmunic');
$cont 	= count($campos);
$tabela = 'parcelas';
$id			= 'idparcela';

echo "class Dao".ucfirst($tabela)." extends conexao { <br> <br>";
echo "public function Atualizar($tabela $$tabela) { <br> <br>";
echo "try { <br> <br>";
echo "if ($".$tabela."->get".ucfirst($id)."() != '') { <br> <br>";
echo '$sql = " UPDATE '.$tabela.' SET <br>';
$i = 0;
foreach ($campos as $value) {
	if ($i == $cont-1){
		echo	$value.' = ? <br>';
	} else {
		echo	$value.' = ?, <br>';
	}
	$i++;
}								
echo'							 WHERE '.$id.' = ? ";';
echo "<br><br>";
echo '$stmt = self::conectar()->prepare($sql);<br>';
$i = 1;
foreach ($campos as $value) {
	echo	'$stmt->bindValue('.$i.', $'.$tabela.'->get'.ucfirst($value).'());<br>';
	$i++;
}								
echo	'$stmt->bindValue('.$i.', $'.$tabela.'->get'.ucfirst($id).'());<br>';
echo "<br><br>";
echo "} else {";
echo "<br><br>";



echo ' $sql  = " INSERT INTO '.$tabela.' (';
$i = 0;
$s = '';
foreach ($campos as $value) {
	if ($i == $cont-1){
		echo	$value.') <br> VALUES ('.$s.'?)";<br>';
	} else {
		echo	$value.',';
		$s = $s.'?,';
	}
	$i++;
}								
echo "<br><br>";

echo '$stmt = self::conectar()->prepare($sql);<br>';
$i = 1;
foreach ($campos as $value) {
	echo	'$stmt->bindValue('.$i.', $'.$tabela.'->get'.ucfirst($value).'());<br>';
	$i++;
}								
echo "<br><br>";

echo '}	<br>

			if ($stmt->execute()){<br>
				return true;<br>
			} else<br>
				return false;<br><br>
				
		} catch (Exception $e) {<br>
				print "Erro ao tentar atualizar: ".$e;<br>
			
		}<br><br>
 
        
   }';

echo "<br><br>";


echo 'public function Pesquisar'.ucfirst($tabela).'($codigo){<br>
		$sql = " SELECT * FROM '.$tabela.' WHERE '.$id.' = ? "; <br>
		$stmt = self::conectar()->prepare($sql);<br>
		$stmt->bindValue(1, $codigo);<br>		  
		$stmt->execute();<br>
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);<br>
		return $result;<br>
	}<br><br>
';

echo 'public function Listar'.ucfirst($tabela).'s(){<br>
		$sql = " SELECT * FROM '.$tabela.' ORDER BY '.$id.' ";<br>
		$stmt = self::conectar()->prepare($sql);<br>
		$stmt->execute();<br>
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);<br>
		return $result;<br>
	}<br><br>
';

echo "}<br> <br>";