# SwedenGroup7

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=lol;charset=utf8', 'root', '');

$stmt = $bdd->prepare('UPDATE table SET var ="'.$var.'" WHERE var2 = "'.$var2.'"');
$stmt->execute();

$stmt = $bdd->query('DELETE FROM table WHERE var = "'.$var.'"');

$stmt = $bdd->prepare('INSERT INTO table(var, var2) VALUES(?, ?)');
$stmt >execute(array($var, $var2));

$datas= $bdd->prepare('SELECT * FROM table WHERE var = ?');
$datas->execute(array($var));
while($data = $datas->fetch())
{

}