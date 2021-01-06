<?php
$f="tarefas.json";
$t=file_exists($f)?json_decode(file_get_contents($f),true):[];
if($_SERVER["REQUEST_METHOD"]==="POST"&&isset($_POST["tarefa"])){
$t[]=["texto"=>htmlspecialchars($_POST["tarefa"]),"feita"=>false];
file_put_contents($f,json_encode($t,JSON_PRETTY_PRINT));
header("Location: index.php");exit;}
if(isset($_GET["remover"])){$i=(int)$_GET["remover"];
if(isset($t[$i])){array_splice($t,$i,1);file_put_contents($f,json_encode($t,JSON_PRETTY_PRINT));}
header("Location: index.php");exit;}
?><!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Lista de Tarefas</title>
<style>*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial;max-width:500px;margin:50px auto;padding:20px;background:#f5f5f5}
h1{margin-bottom:20px}form{display:flex;gap:10px;margin-bottom:20px}
input[type=text]{flex:1;padding:10px;border:1px solid #ddd;border-radius:4px}
button{padding:10px 20px;background:#4CAF50;color:white;border:none;border-radius:4px;cursor:pointer}
ul{list-style:none}li{background:white;padding:12px;margin-bottom:5px;border-radius:4px;display:flex;justify-content:space-between;box-shadow:0 1px 3px rgba(0,0,0,0.1)}
.del{color:#f44336;text-decoration:none;font-weight:bold}
</style></head>
<body><h1>Lista de Tarefas</h1>
<form method="POST"><input type="text" name="tarefa" placeholder="Nova tarefa..." required><button type="submit">Adicionar</button></form>
<?php if(count($t)>0):?><ul>
<?php foreach($t as $i=>$v):?><li><span><?=htmlspecialchars($v["texto"])?></span><a href="?remover=<?=$i?>" class="del" onclick="return confirm('Remover?')">X</a></li>
<?php endforeach;?></ul>
<?php else:?><p style="color:#999">Nenhuma tarefa ainda.</p><?php endif;?>
</body></html>
