<?php
echo "< ?php <br><br>";


$aux = '$';
$campos = array('idparcela','idsecaolog','idquadra','numero','ocupacao','situacao','topografia','pedologia','posicao','uso','formaaquisicao	','fecho','testada','codparcela','drenagem','geo','latlong','URL','status','fotografia','geocodmunic');
$tabela = "parcelas";

echo "class ".$tabela." { <br> <br>";



foreach ($campos as $value) {
	echo "private ".$aux.$value.";<br>";	
}
echo "<br>";

foreach ($campos as $value) {
	
   		
	echo"	 public function get".ucfirst($value)."(){<br>
		 <span style='display:inline-block; 
       margin-left: 40px;'>return ".$aux."this->".$value.";</span><br> 
	 }<br><br>
	 
	 public function set".ucfirst($value)."($".$value."){<br>
		  <span style='display:inline-block; 
       margin-left: 40px;'>".$aux."this->".$value." = $".$value.";</span> <br>
	 }<br><br> ";
}
echo "}<br> <br>
? >";