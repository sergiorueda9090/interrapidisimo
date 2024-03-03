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



}