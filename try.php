<?php
$ar = ["albero", "banana", "cacio", "dalmata"];
echo "1:\n";
for ($i = 0; $i < count($ar); $i++) {
  echo $ar[$i]."\n";
}
unset($ar[2]);
sort($ar);

echo "2:\n";
for ($i = 0; $i < count($ar); $i++) {
  echo $ar[$i]."\n";
}

?>
