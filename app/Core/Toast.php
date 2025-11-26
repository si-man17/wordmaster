<?php
namespace App\Core;

class Toast{
    public static $html = "";
    private $types = [
        'success',
        'warning'
    ];

    public static function addHtmlJs(){
        return '<div class="toast-container position-fixed top-0 end-0 p-3">
                    <div id="myToastMain" class="toast" role="alert">
                        <div class="toast-header">
                            <strong class="me-auto">Уведомление</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            
                        </div>
                    </div>
                </div>

                <script>
                    function showToast(message, type) {
                        const toastEl = document.getElementById("myToastMain");
                        const toastBody = toastEl.querySelector(".toast-body");
                        toastBody.textContent = message;
                        const toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    }
                </script>';
    }

    public static function add($message, $type='info'){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['toast']['message'] = $message;
        $_SESSION['toast']['type'] = $type;
    }

    public static function show(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['toast'])){
            $message = $_SESSION['toast']['message'];
            $type = $_SESSION['toast']['message'];
            unset($_SESSION['toast']);
            return sprintf("<script>showToast('%s', '%s');</script>", $message, $type);
        }
        return null;
    }



    // public static function getSimpleToast($type='', $name = 'Уведомление', $message, $block_id=''){
    //     if (empty($block_id)) $block_id = rand(0,10000000) . '_toast_block';
    //     return 
    //     '<div class="toast-container position-fixed top-0 end-0 p-3">
    //         <div id="'.$block_id.'" class="toast" role="alert">
    //             <div class="toast-header">
    //                 <strong class="me-auto">'.$name.'</strong>
    //                 <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    //             </div>
    //             <div class="toast-body">
    //                 '.$message.'
    //             </div>
    //         </div>
    //     </div>
    //     <script>
    //         const toastEl_'.$block_id.' = document.getElementById("'.$block_id.'");
    //         const toast_'.$block_id.' = new bootstrap.Toast(toastEl_'.$block_id.');
    //         toast.show();
    //     </script>';
    // }
}