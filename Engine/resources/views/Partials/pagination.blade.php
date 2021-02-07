@if(isset($data->data->pagination))
<?php
$current_page = $data->data->pagination->current_page;
$total_pages = $data->data->pagination->last_page;
$per_page = 15;
$page = $current_page;

$total = $total_pages;
$adjacents = "2";
$prevlabel = "السابق";
$nextlabel = "التالي";

$page = ($page == 0 ? 1 : $page);
$start = ($page - 1) * $per_page;

$first = 1;
$prev = $page - 1;
$next = $page + 1;

//dd($_SERVER['QUERY_STRING']);
$paramsOld = strpos($_SERVER['REQUEST_URI'],'?') != false ? $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'].'?';
//dd($paramsOld);

$url = str_replace('&page='.$prev,'',$paramsOld);
$url = str_replace('?page='.$prev,'?',$url);
$url = str_replace('?page='.$page,'?',$url);
$url = str_replace('&page='.$page,'',$url);

$url .= \Request::getQueryString() != "" ? strpos($_SERVER['REQUEST_URI'],'?page=') != false ? '' : '&' : '';

$lastpage = $total_pages;

$lpm1 = $lastpage - 1;
$pagination = '';

if($lastpage > 1){
    $pagination .= "<div class='pagiDiv clearfix'>";
    
    if ($page > 1) $pagination.= "<a href='{$url}page={$prev}' class='prev'>{$prevlabel}</a>";
    $pagination .= "<ul class='pagination'>";

    if ($lastpage < 7 + ($adjacents * 2)){
        for ($counter = 1; $counter <= $lastpage; $counter++){
            if ($counter == $page){
                $pagination.= "<li><a class='active'>{$counter}</a></li>";

            } else{
                $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
            }
        }
    } elseif($lastpage > 5 + ($adjacents * 2)){

        if($page < 1 + ($adjacents * 2)) {

            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                if ($counter == $page){
                    $pagination.= "<li><a class='active'>{$counter}</a></li>";
                } else{
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }
            }

            $pagination.= "<li class='dot'>...</li>";
            $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
            $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

        } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>...</li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                if ($counter == $page){
                    $pagination.= "<li><a class='active'>{$counter}</a></li>";
                } else{
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";

                }
            }
            $pagination.= "<li class='dot'>..</li>";
            $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
            $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

        } else {

            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>..</li>";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page){
                    $pagination.= "<li><a class='active'>{$counter}</a></li>";
                } else{
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }
            }
        }
    }

    $pagination.= "</ul>";
    if ($page < $counter - 1) {
        $pagination.= "<a href='{$url}page={$next}' class='next'>{$nextlabel}</a>";
    }
    $pagination.= "</div>";    
}


?>

<?php echo $pagination; ?>
@endif
