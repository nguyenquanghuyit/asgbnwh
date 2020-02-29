<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$vworderout_list = new vworderout_list();

// Run the page
$vworderout_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderout_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vworderout->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvworderoutlist = currentForm = new ew.Form("fvworderoutlist", "list");
fvworderoutlist.formKeyCountName = '<?php echo $vworderout_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvworderoutlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworderoutlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvworderoutlist.lists["x_StatusFinishOrder"] = <?php echo $vworderout_list->StatusFinishOrder->Lookup->toClientList() ?>;
fvworderoutlist.lists["x_StatusFinishOrder"].options = <?php echo JsonEncode($vworderout_list->StatusFinishOrder->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$vworderout->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vworderout_list->TotalRecs > 0 && $vworderout_list->ExportOptions->visible()) { ?>
<?php $vworderout_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vworderout_list->ImportOptions->visible()) { ?>
<?php $vworderout_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vworderout->isExport() || EXPORT_MASTER_RECORD && $vworderout->isExport("print")) { ?>
<?php
if ($vworderout_list->DbMasterFilter <> "" && $vworderout->getCurrentMasterTable() == "vwrouteout") {
	if ($vworderout_list->MasterRecordExists) {
		include_once "vwrouteoutmaster.php";
	}
}
?>
<?php } ?>
<?php
$vworderout_list->renderOtherOptions();
?>
<?php $vworderout_list->showPageHeader(); ?>
<?php
//$vworderout_list->showMessage();
?>
<?php if ($vworderout_list->TotalRecs > 0 || $vworderout->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworderout_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworderout">
<?php if (!$vworderout->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vworderout->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworderout_list->Pager)) $vworderout_list->Pager = new PrevNextPager($vworderout_list->StartRec, $vworderout_list->DisplayRecs, $vworderout_list->TotalRecs, $vworderout_list->AutoHidePager) ?>
<?php if ($vworderout_list->Pager->RecordCount > 0 && $vworderout_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworderout_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworderout_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworderout_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworderout_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworderout_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworderout_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworderout_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderout_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderout_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderout_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworderout_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvworderoutlist" id="fvworderoutlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vworderout_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vworderout_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vworderout">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vworderout->getCurrentMasterTable() == "vwrouteout" && $vworderout->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwrouteout">
<input type="hidden" name="fk_ID_Route" value="<?php echo $vworderout->ID_Route->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vworderout" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vworderout_list->TotalRecs > 0 || $vworderout->isGridEdit()) { ?>
<table id="tbl_vworderoutlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworderout_list->RowType = ROWTYPE_HEADER;

// Render list options
$vworderout_list->renderListOptions();

// Render list options (header, left)
$vworderout_list->ListOptions->render("header", "left");
?>
<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vworderout->sortUrl($vworderout->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vworderout->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ID_Order" class="vworderout_ID_Order"><div class="ew-table-header-caption"><?php echo $vworderout->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vworderout->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->ID_Order) ?>',2);"><div id="elh_vworderout_ID_Order" class="vworderout_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->Code->Visible) { // Code ?>
	<?php if ($vworderout->sortUrl($vworderout->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vworderout->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_Code" class="vworderout_Code"><div class="ew-table-header-caption"><?php echo $vworderout->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vworderout->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->Code) ?>',2);"><div id="elh_vworderout_Code" class="vworderout_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->PCS->Visible) { // PCS ?>
	<?php if ($vworderout->sortUrl($vworderout->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vworderout->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_PCS" class="vworderout_PCS"><div class="ew-table-header-caption"><?php echo $vworderout->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vworderout->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->PCS) ?>',2);"><div id="elh_vworderout_PCS" class="vworderout_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vworderout->sortUrl($vworderout->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vworderout->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_OrderDate" class="vworderout_OrderDate"><div class="ew-table-header-caption"><?php echo $vworderout->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vworderout->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->OrderDate) ?>',2);"><div id="elh_vworderout_OrderDate" class="vworderout_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
	<?php if ($vworderout->sortUrl($vworderout->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $vworderout->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ContactName" class="vworderout_ContactName"><div class="ew-table-header-caption"><?php echo $vworderout->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $vworderout->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->ContactName) ?>',2);"><div id="elh_vworderout_ContactName" class="vworderout_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ContactName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vworderout->sortUrl($vworderout->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $vworderout->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_CompanyName" class="vworderout_CompanyName"><div class="ew-table-header-caption"><?php echo $vworderout->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $vworderout->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->CompanyName) ?>',2);"><div id="elh_vworderout_CompanyName" class="vworderout_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->CompanyName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($vworderout->sortUrl($vworderout->ContactPhone) == "") { ?>
		<th data-name="ContactPhone" class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ContactPhone" class="vworderout_ContactPhone"><div class="ew-table-header-caption"><?php echo $vworderout->ContactPhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPhone" class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->ContactPhone) ?>',2);"><div id="elh_vworderout_ContactPhone" class="vworderout_ContactPhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ContactPhone->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ContactPhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ContactPhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->StatusFinishOrder) == "") { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->StatusFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->StatusFinishOrder) ?>',2);"><div id="elh_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->StatusFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->StatusFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->StatusFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->DateTimefinishOrder) == "") { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->DateTimefinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->DateTimefinishOrder) ?>',2);"><div id="elh_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->DateTimefinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->DateTimefinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->DateTimefinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->UserFinishOrder) == "") { ?>
		<th data-name="UserFinishOrder" class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->UserFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserFinishOrder" class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderout->SortUrl($vworderout->UserFinishOrder) ?>',2);"><div id="elh_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->UserFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->UserFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->UserFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderout_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vworderout->ExportAll && $vworderout->isExport()) {
	$vworderout_list->StopRec = $vworderout_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vworderout_list->TotalRecs > $vworderout_list->StartRec + $vworderout_list->DisplayRecs - 1)
		$vworderout_list->StopRec = $vworderout_list->StartRec + $vworderout_list->DisplayRecs - 1;
	else
		$vworderout_list->StopRec = $vworderout_list->TotalRecs;
}
$vworderout_list->RecCnt = $vworderout_list->StartRec - 1;
if ($vworderout_list->Recordset && !$vworderout_list->Recordset->EOF) {
	$vworderout_list->Recordset->moveFirst();
	$selectLimit = $vworderout_list->UseSelectLimit;
	if (!$selectLimit && $vworderout_list->StartRec > 1)
		$vworderout_list->Recordset->move($vworderout_list->StartRec - 1);
} elseif (!$vworderout->AllowAddDeleteRow && $vworderout_list->StopRec == 0) {
	$vworderout_list->StopRec = $vworderout->GridAddRowCount;
}

// Initialize aggregate
$vworderout->RowType = ROWTYPE_AGGREGATEINIT;
$vworderout->resetAttributes();
$vworderout_list->renderRow();
while ($vworderout_list->RecCnt < $vworderout_list->StopRec) {
	$vworderout_list->RecCnt++;
	if ($vworderout_list->RecCnt >= $vworderout_list->StartRec) {
		$vworderout_list->RowCnt++;

		// Set up key count
		$vworderout_list->KeyCount = $vworderout_list->RowIndex;

		// Init row class and style
		$vworderout->resetAttributes();
		$vworderout->CssClass = "";
		if ($vworderout->isGridAdd()) {
		} else {
			$vworderout_list->loadRowValues($vworderout_list->Recordset); // Load row values
		}
		$vworderout->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vworderout->RowAttrs = array_merge($vworderout->RowAttrs, array('data-rowindex'=>$vworderout_list->RowCnt, 'id'=>'r' . $vworderout_list->RowCnt . '_vworderout', 'data-rowtype'=>$vworderout->RowType));

		// Render row
		$vworderout_list->renderRow();

		// Render list options
		$vworderout_list->renderListOptions();
?>
	<tr<?php echo $vworderout->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderout_list->ListOptions->render("body", "left", $vworderout_list->RowCnt);
?>
	<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vworderout->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_ID_Order" class="vworderout_ID_Order">
<span<?php echo $vworderout->ID_Order->viewAttributes() ?>>
<?php echo $vworderout->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vworderout->Code->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_Code" class="vworderout_Code">
<span<?php echo $vworderout->Code->viewAttributes() ?>>
<?php echo $vworderout->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vworderout->PCS->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_PCS" class="vworderout_PCS">
<span<?php echo $vworderout->PCS->viewAttributes() ?>>
<?php echo $vworderout->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vworderout->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_OrderDate" class="vworderout_OrderDate">
<span<?php echo $vworderout->OrderDate->viewAttributes() ?>>
<?php echo $vworderout->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $vworderout->ContactName->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_ContactName" class="vworderout_ContactName">
<span<?php echo $vworderout->ContactName->viewAttributes() ?>>
<?php echo $vworderout->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $vworderout->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_CompanyName" class="vworderout_CompanyName">
<span<?php echo $vworderout->CompanyName->viewAttributes() ?>>
<?php echo $vworderout->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone"<?php echo $vworderout->ContactPhone->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_ContactPhone" class="vworderout_ContactPhone">
<span<?php echo $vworderout->ContactPhone->viewAttributes() ?>>
<?php echo $vworderout->ContactPhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td data-name="StatusFinishOrder"<?php echo $vworderout->StatusFinishOrder->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder">
<span<?php echo $vworderout->StatusFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->StatusFinishOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
		<td data-name="DateTimefinishOrder"<?php echo $vworderout->DateTimefinishOrder->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder">
<span<?php echo $vworderout->DateTimefinishOrder->viewAttributes() ?>>
<?php echo $vworderout->DateTimefinishOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
		<td data-name="UserFinishOrder"<?php echo $vworderout->UserFinishOrder->cellAttributes() ?>>
<span id="el<?php echo $vworderout_list->RowCnt ?>_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder">
<span<?php echo $vworderout->UserFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->UserFinishOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderout_list->ListOptions->render("body", "right", $vworderout_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vworderout->isGridAdd())
		$vworderout_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vworderout->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vworderout_list->Recordset)
	$vworderout_list->Recordset->Close();
?>
<?php if (!$vworderout->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vworderout->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworderout_list->Pager)) $vworderout_list->Pager = new PrevNextPager($vworderout_list->StartRec, $vworderout_list->DisplayRecs, $vworderout_list->TotalRecs, $vworderout_list->AutoHidePager) ?>
<?php if ($vworderout_list->Pager->RecordCount > 0 && $vworderout_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworderout_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworderout_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworderout_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworderout_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworderout_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworderout_list->pageUrl() ?>start=<?php echo $vworderout_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworderout_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworderout_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderout_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderout_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderout_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworderout_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworderout_list->TotalRecs == 0 && !$vworderout->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworderout_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworderout_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vworderout->isExport()) { ?>
<script>
$(document).ready(function(){
	$(".ew-print").click(function(event){
		window.location="BM01_QT_PVHMMV.php?id=<?php echo $_REQUEST["fk_ID_Route"];?>";					 
	});					   
						   
})
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vworderout_list->terminate();
?>