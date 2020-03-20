<?php
$ar = ["albero", "banana", "cacio", "dalmata"];
echo "1:\n";
for ($i = 0; $i < count($ar); $i++) {
  echo $ar[$i]."\n";
}

sort($ar);

echo "2:\n";
for ($i = 0; $i < count($ar); $i++) {
  echo $ar[$i]."\n";
}

?>
