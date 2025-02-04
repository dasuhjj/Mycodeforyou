<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; // फोटो को सेव करने के लिए फोल्डर
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // चेक करें क्या यह एक इमेज है
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "यह एक इमेज है - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "यह एक इमेज नहीं है.";
            $uploadOk = 0;
        }
    }

    // चेक करें कि क्या फोटो पहले से मौजूद है
    if (file_exists($target_file)) {
        echo "यह फाइल पहले से मौजूद है.";
        $uploadOk = 0;
    }

    // इमेज का साइज चेक करें
    if ($_FILES["fileUpload"]["size"] > 500000) {
        echo "फाइल का आकार अधिक है.";
        $uploadOk = 0;
    }

    // सिर्फ कुछ विशिष्ट फाइल प्रकारों की अनुमति दें
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "केवल JPG, JPEG, PNG और GIF प्रकार की फाइलें ही अनुमत हैं.";
        $uploadOk = 0;
    }

    // अगर सब कुछ ठीक है, तो इमेज अपलोड करें
    if ($uploadOk == 0) {
        echo "आपकी फोटो अपलोड नहीं हो पाई.";
    } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            echo "फोटो ". basename($_FILES["fileUpload"]["name"]). " सफलतापूर्वक अपलोड हो गई है.";
        } else {
            echo "फाइल अपलोड करते समय एक त्रुटि हुई.";
        }
    }
}
?>
