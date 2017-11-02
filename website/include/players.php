<?php
  $con = mysqli_connect("localhost", "root", "ascent", "characters");

  if (mysqli_connect_errno())
  {
    echo "<p>Failed to prepare connection</p>";
  }

  function getRaceIcon($race, $gender)
  {
    $iconstring = "";
    switch($race)
    {
      case '1':
        $iconstring = $gender == 1 ? "images/icons/races_human-female.png" : "images/icons/races_human-male.png";
        break;
      case '2':
        $iconstring = $gender == 1 ? "images/icons/races_orc-female.png" : "images/icons/races_orc-male.png";
        break;
      case '3':
        $iconstring = $gender == 1 ? "images/icons/races_dwarf-female.png" : "images/icons/races_dwarf-male.png";
        break;
      case '4':
        $iconstring = $gender == 1 ? "images/icons/races_nightelf-female.png" : "images/icons/races_nightelf-male.png";
        break;
      case '5':
        $iconstring = $gender == 1 ? "images/icons/races_undead-female.png" : "images/icons/races_undead-male.png";
        break;
      case '6':
        $iconstring = $gender == 1 ? "images/icons/races_tauren-female.png" : "images/icons/races_tauren-male.png";
        break;
      case '7':
        $iconstring = $gender == 1 ? "images/icons/races_gnome-female.png" : "images/icons/races_gnome-male.png";
        break;
      case '8':
        $iconstring = $gender == 1 ? "images/icons/races_troll-female.png" : "images/icons/races_troll-male.png";
        break;
      case '10':
        $iconstring = $gender == 1 ? "images/icons/races_bloodelf-female.png" : "images/icons/races_bloodelf-male.png";
        break;
      case '11':
        $iconstring = $gender == 1 ? "images/icons/races_draenei-female.png" : "images/icons/races_draenei-male.png";
        break;
    }

    return $iconstring;
  }
 
  function getClassIcon($class)
  {
    $iconstring = "";
    switch($class)
    {
      case '1':
        $iconstring = "images/icons/classes_warrior.png";
        break;
      case '2':
        $iconstring = "images/icons/classes_paladin.png";
        break;
      case '3':
        $iconstring = "images/icons/classes_hunter.png";
        break;
      case '4':
        $iconstring = "images/icons/classes_rogue.png";
        break;
      case '5':
        $iconstring = "images/icons/classes_priest.png";
        break;
      case '6':
        $iconstring = "images/icons/classes_deathknight.png";
        break;
      case '7':
        $iconstring = "images/icons/classes_shaman.png";
        break;
      case '8':
        $iconstring = "images/icons/classes_mage.png";
        break;
      case '9':
        $iconstring = "images/icons/classes_warlock.png";
        break;
      case '11':
        $iconstring = "images/icons/classes_druid.png";
        break;
    }

    return $iconstring;
  }
  /*echo "<tr>";
      echo "<td>".$row["name"]."</th>";
      echo "<td>".$row["level"]."</th>";
      echo "<td class=".rowColor((int)$row["category"]).">".getIcon((int)$row["category"])."    ".getCategory((int)$row["category"])."</th>";
      //echo $row["name"] . " " . $row["level"] . " " . $row["category"];
      echo "</tr>";
*/
  function executeStatement($statement)
  {
    $statement->execute();
    $result = $statement->get_result();
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["level"]."</td>";
        echo "<td><img class='class-icon' src='" . getClassIcon($row['class']) . "'/></td>";
        echo "<td><img class='class-icon' src='" . getRaceIcon($row['race'], $row['gender']) . "'/></td>";
        echo "</tr>";
      }
    } else 
    {
      echo "<p>No players online</p>";
    }

  }

  $stmt1 = $con->prepare("SELECT race, gender, class, name, level FROM characters WHERE online=1 ORDER BY level DESC");
  executeStatement($stmt1);
