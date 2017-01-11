<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

$projetos = [];
$dirs = array_filter(glob('*'), 'is_dir');
foreach ($dirs as $dir){
    $path = $_SERVER['DOCUMENT_ROOT']."/".$dir."/";

    if (file_exists($path."index.php")) {
        $projetos[] = [
            'dir'  => rawurlencode($dir),
            'nome' => $dir,
            'read' => (file_exists($path."desc.md") ? htmlspecialchars(file_get_contents($path."desc.md")) : null)
        ];
    }
}
usort($projetos, function($a, $b) {
    return strnatcmp($a['nome'], $b['nome']);
});

require "view/list.view.php";
