    <?php
function check(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "cafe";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->execute([$_GET["id"]]);
}
check();
?> 