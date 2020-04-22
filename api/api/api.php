<?php
        header('Access-Control-Allow-Origin: *');
        $url = "https://wandbox.org/api/compile.json";
        
        //$code = "#include <iostream>\nint main() { int x = 0; std::cout << \"fefefefe\" << std::endl; }";
        $code = $_GET["code"];
        $data = array(
            "code" => $code,
            "options" =>  "warning,gnu++1y",
            "compiler" => "gcc-head",
            "compiler-option-raw" => "-Dx=hogefuga\n-O3"
        );

        $options = array(
            'http' => array(
              'method'  => 'POST',
              'content' => json_encode( $data ),
              'header'=>  "Content-Type: application/json\r\n",
              "ignore_errors" => false
              )
        );

        $context  = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $result = json_decode($result);
         
        echo($result->program_output);
?>