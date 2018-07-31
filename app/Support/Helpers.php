<?php
/*
*
* Function responsible by transform rows in columns and 
* generate table html of classification
*
* @param $parameters List parameters
* @return mixed
* @author Bruno Barroso
*
*/
if( ! function_exists('generateTableClassification') )
{
    function generateTableClassification( $parameters, $selected = null )
    {
        $html = '';
        $maxParameters = 5;
        for( $i=0; $i < $maxParameters; $i++ ){
            $html .= "<tr>";
                if(isset($parameters['time'][$i]['name'])){
                    $html .= "<td><input type='checkbox' id='time' name='time_id' value='{$parameters['time'][$i]['id']}' ".isCheck($parameters['time'][$i]['id'], $selected)."> {$parameters['time'][$i]['name']}</td>";
                }else{
                    $html .= "<td></td>";
                }
                if(isset($parameters['priority'][$i]['name'])){
                    $html .= "<td><input type='checkbox' id='priority' name='priority_id' value='{$parameters['priority'][$i]['id']}' ".isCheck($parameters['priority'][$i]['id'], $selected)."> {$parameters['priority'][$i]['name']}</td>";
                }else{
                    $html .= "<td></td>";
                }
                if(isset($parameters['knowledge'][$i]['name'])){
                    $html .= "<td><input type='checkbox' id='knowledge' name='knowledge_id' value='{$parameters['knowledge'][$i]['id']}' ".isCheck($parameters['knowledge'][$i]['id'], $selected)."> {$parameters['knowledge'][$i]['name']}</td>";
                }else{
                    $html .= "<td></td>";
                }
            $html .= "</tr>";
        }
        
        return $html;
                    
    }

}

/*
*
* Function responsible by prepare of parameters array and return
* in expected format of Classification page
*
* @param $parameters List parameters
* @return mixed
* @author Bruno Barroso
*
*/
if( ! function_exists('prepareParameters') )
{
    function prepareParameters($parameters){
        $parameters = $parameters->toArray();
        try{
            foreach($parameters as $param){
                if($param['type'] == 'time'){
                    $list['time'][] = $param;
                }else if($param['type'] == 'priority'){
                    $list['priority'][] = $param;
                }else{
                    $list['knowledge'][] = $param;
                }
            }
        }catch(\Exception $ex){
            throw new \Exception('Not possible prepare parameters');
        }
        return $list;
    }
}

/*
*
* Function responsible by check field
* if first parameter is equals second parameter
*
* @param $id first parameter
* @param $idSelected second parameter to be compared
* @return mixed
* @author Bruno Barroso
*
*/
if( ! function_exists('isCheck') )
{
    function isCheck($id, $idSelected)
    {
        if($idSelected)
            if(in_array($id, $idSelected))
                return 'checked';
    }
}


/*
*
* Function responsible by apply formula of score
*
* @param $parameters parameters selected
* @return integer value score by task
* @author Bruno Barroso
*
*/
if( ! function_exists('applyFormula') )
{
    function applyFormula($parameters)
    {
        $time = 0; $knowledge = 0; $priority = 0;

        foreach($parameters->toArray() as $parameter){
            switch( $parameter['type'] ){
                case 'time':
                    $time = $parameter['weight'];
                    break;
                case 'knowledge':
                    $knowledge = $parameter['weight'];
                    break;
                case 'priority':
                    $priority = $parameter['weight'];
                    break;
            }

        }

        return ( ($time + $knowledge) * $priority ) / 2;
    }
}