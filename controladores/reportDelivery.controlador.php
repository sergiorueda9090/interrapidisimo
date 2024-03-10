<?php

class ReportDeliveryCtr{

    /*=============================================
	LIST DELIVERY 
	=============================================*/
    static public function ctrListReportsDeliverys(){
        
        $response = RportDeliveryMdl::mdllistReportDelivery($id=null);

        return $response;

    }

    /*=============================================
	SHOW DELIVERY 
	=============================================*/
    static public function ctrShowReportDeliverys($id){

        $response = RportDeliveryMdl::mdlListReportDelivery($id);

        return $response;

    }

    /*=============================================
	FILTER LIST DELIVERY 
	=============================================*/
    static public function ctrFilterListReportsDeliverys($fecha_inicio,$fecha_fin,$mensajero,$cliente){
        
        $response = RportDeliveryMdl::mdlFilterlistReportDelivery($fecha_inicio,$fecha_fin,$mensajero,$cliente);

        return $response;

    }
    /*=============================================
	END FILTER LIST DELIVERY 
	=============================================*/

}