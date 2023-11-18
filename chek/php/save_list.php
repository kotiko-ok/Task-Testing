<?
$servername = "localhost"; 
$username = "o96010tc_bd"; 
$password = "HDC&2a6J";   
$dbname = "o96010tc_bd";   

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        echo $_POST["name"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $id_creator = $_POST["id_creator"];
        $date = date('Y-m-d H:i:s');

        
        $stmt = $conn->prepare("INSERT INTO `checklists` (name, description, id_creator, date_creation, date_update) VALUES (:name, :description, :id_creator, :date, :date)");

        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_creator', $id_creator);
        $stmt->bindParam(':date', $date);

        $stmt->execute();

        $stmt = $pdo->query("SELECT MAX(id_checklist) as last_id FROM checklists");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row['last_id'];
       
        echo $lastId;
    
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

$conn = null; 
?>

