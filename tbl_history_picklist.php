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
$tbl_history_pick_list = new tbl_history_pick_list();

// Run the page
$tbl_history_pick_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_pick_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_history_pick->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_history_picklist = currentForm = new ew.Form("ftbl_history_picklist", "list");
ftbl_history_picklist.formKeyCountName = '<?php echo $tbl_history_pick_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_history_picklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_history_picklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_history_picklist.lists["x_ID_Location"] = <?php echo $tbl_history_pick_list->ID_Location->Lookup->toClientList() ?>;
ftbl_history_picklist.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_history_pick_list->ID_Location->lookupOptions()) ?>;
ftbl_history_picklist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

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
<?php if (!$tbl_history_pick->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_history_pick_list->TotalRecs > 0 && $tbl_history_pick_list->ExportOptions->visible()) { ?>
<?php $tbl_history_pick_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_history_pick_list->ImportOptions->visible()) { ?>
<?php $tbl_history_pick_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_history_pick->isExport() || EXPORT_MASTER_RECORD && $tbl_history_pick->isExport("print")) { ?>
<?php
if ($tbl_history_pick_list->DbMasterFilter <> "" && $tbl_history_pick->getCurrentMasterTable() == "vwpickingbyorder") {
	if ($tbl_history_pick_list->MasterRecordExists) {
		include_once "vwpickingbyordermaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_history_pick_list->renderOtherOptions();
?>
<?php $tbl_history_pick_list->showPageHeader(); ?>
<?php
$tbl_history_pick_list->showMessage();
?>
<?php if ($tbl_history_pick_list->TotalRecs > 0 || $tbl_history_pick->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_history_pick_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_history_pick">
<?php if (!$tbl_history_pick->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_history_pick->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_history_pick_list->Pager)) $tbl_history_pick_list->Pager = new PrevNextPager($tbl_history_pick_list->StartRec, $tbl_history_pick_list->DisplayRecs, $tbl_history_pick_list->TotalRecs, $tbl_history_pick_list->AutoHidePager) ?>
<?php if ($tbl_history_pick_list->Pager->RecordCount > 0 && $tbl_history_pick_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_history_pick_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_history_pick_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_history_pick_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_history_pick_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_history_pick_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_history_pick_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_history_pick_list->TotalRecs > 0 && (!$tbl_history_pick_list->AutoHidePageSizeSelector || $tbl_history_pick_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_history_pick">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_history_pick_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_history_pick_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_history_pick_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_history_pick_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_history_pick_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_history_pick->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_history_pick_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_history_picklist" id="ftbl_history_picklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_pick_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_pick_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history_pick">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_history_pick->getCurrentMasterTable() == "vwpickingbyorder" && $tbl_history_pick->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwpickingbyorder">
<input type="hidden" name="fk_ID_Order" value="<?php echo $tbl_history_pick->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_history_pick" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_history_pick_list->TotalRecs > 0 || $tbl_history_pick->isGridEdit()) { ?>
<table id="tbl_tbl_history_picklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_history_pick_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_history_pick_list->renderListOptions();

// Render list options (header, left)
$tbl_history_pick_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->PalletID) ?>',2);"><div id="elh_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_Code" class="tbl_history_pick_Code"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->Code) ?>',2);"><div id="elh_tbl_history_pick_Code" class="tbl_history_pick_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->ID_Location) ?>',2);"><div id="elh_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PCS" class="tbl_history_pick_PCS"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->PCS) ?>',2);"><div id="elh_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->DateIn) ?>',2);"><div id="elh_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->User_ID) == "") { ?>
		<th data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->User_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->User_ID) ?>',2);"><div id="elh_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->User_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->User_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->User_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PalletStatus) == "") { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->PalletStatus) ?>',2);"><div id="elh_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PalletStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PalletStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->CreateUser) ?>',2);"><div id="elh_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->CreateDate) ?>',2);"><div id="elh_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_Box" class="tbl_history_pick_Box"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history_pick->SortUrl($tbl_history_pick->Box) ?>',2);"><div id="elh_tbl_history_pick_Box" class="tbl_history_pick_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_history_pick_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_history_pick->ExportAll && $tbl_history_pick->isExport()) {
	$tbl_history_pick_list->StopRec = $tbl_history_pick_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_history_pick_list->TotalRecs > $tbl_history_pick_list->StartRec + $tbl_history_pick_list->DisplayRecs - 1)
		$tbl_history_pick_list->StopRec = $tbl_history_pick_list->StartRec + $tbl_history_pick_list->DisplayRecs - 1;
	else
		$tbl_history_pick_list->StopRec = $tbl_history_pick_list->TotalRecs;
}
$tbl_history_pick_list->RecCnt = $tbl_history_pick_list->StartRec - 1;
if ($tbl_history_pick_list->Recordset && !$tbl_history_pick_list->Recordset->EOF) {
	$tbl_history_pick_list->Recordset->moveFirst();
	$selectLimit = $tbl_history_pick_list->UseSelectLimit;
	if (!$selectLimit && $tbl_history_pick_list->StartRec > 1)
		$tbl_history_pick_list->Recordset->move($tbl_history_pick_list->StartRec - 1);
} elseif (!$tbl_history_pick->AllowAddDeleteRow && $tbl_history_pick_list->StopRec == 0) {
	$tbl_history_pick_list->StopRec = $tbl_history_pick->GridAddRowCount;
}

// Initialize aggregate
$tbl_history_pick->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_history_pick->resetAttributes();
$tbl_history_pick_list->renderRow();
while ($tbl_history_pick_list->RecCnt < $tbl_history_pick_list->StopRec) {
	$tbl_history_pick_list->RecCnt++;
	if ($tbl_history_pick_list->RecCnt >= $tbl_history_pick_list->StartRec) {
		$tbl_history_pick_list->RowCnt++;

		// Set up key count
		$tbl_history_pick_list->KeyCount = $tbl_history_pick_list->RowIndex;

		// Init row class and style
		$tbl_history_pick->resetAttributes();
		$tbl_history_pick->CssClass = "";
		if ($tbl_history_pick->isGridAdd()) {
		} else {
			$tbl_history_pick_list->loadRowValues($tbl_history_pick_list->Recordset); // Load row values
		}
		$tbl_history_pick->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_history_pick->RowAttrs = array_merge($tbl_history_pick->RowAttrs, array('data-rowindex'=>$tbl_history_pick_list->RowCnt, 'id'=>'r' . $tbl_history_pick_list->RowCnt . '_tbl_history_pick', 'data-rowtype'=>$tbl_history_pick->RowType));

		// Render row
		$tbl_history_pick_list->renderRow();

		// Render list options
		$tbl_history_pick_list->renderListOptions();
?>
	<tr<?php echo $tbl_history_pick->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_history_pick_list->ListOptions->render("body", "left", $tbl_history_pick_list->RowCnt);
?>
	<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_history_pick->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
<span<?php echo $tbl_history_pick->PalletID->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_history_pick->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_Code" class="tbl_history_pick_Code">
<span<?php echo $tbl_history_pick->Code->viewAttributes() ?>>
<?php echo $tbl_history_pick->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_history_pick->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
<span<?php echo $tbl_history_pick->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history_pick->ID_Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_history_pick->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
<span<?php echo $tbl_history_pick->PCS->viewAttributes() ?>>
<?php echo $tbl_history_pick->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_history_pick->DateIn->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
<span<?php echo $tbl_history_pick->DateIn->viewAttributes() ?>>
<?php echo $tbl_history_pick->DateIn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<td data-name="User_ID"<?php echo $tbl_history_pick->User_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
<span<?php echo $tbl_history_pick->User_ID->viewAttributes() ?>>
<?php echo $tbl_history_pick->User_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus"<?php echo $tbl_history_pick->PalletStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
<span<?php echo $tbl_history_pick->PalletStatus->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_history_pick->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
<span<?php echo $tbl_history_pick->CreateUser->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_history_pick->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
<span<?php echo $tbl_history_pick->CreateDate->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $tbl_history_pick->Box->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_pick_list->RowCnt ?>_tbl_history_pick_Box" class="tbl_history_pick_Box">
<span<?php echo $tbl_history_pick->Box->viewAttributes() ?>>
<?php echo $tbl_history_pick->Box->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_history_pick_list->ListOptions->render("body", "right", $tbl_history_pick_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_history_pick->isGridAdd())
		$tbl_history_pick_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_history_pick->RowType = ROWTYPE_AGGREGATE;
$tbl_history_pick->resetAttributes();
$tbl_history_pick_list->renderRow();
?>
<?php if ($tbl_history_pick_list->TotalRecs > 0 && !$tbl_history_pick->isGridAdd() && !$tbl_history_pick->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_history_pick_list->renderListOptions();

// Render list options (footer, left)
$tbl_history_pick_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->footerCellClass() ?>"><span id="elf_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_history_pick->Code->footerCellClass() ?>"><span id="elf_tbl_history_pick_Code" class="tbl_history_pick_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->footerCellClass() ?>"><span id="elf_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_history_pick->PCS->footerCellClass() ?>"><span id="elf_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->footerCellClass() ?>"><span id="elf_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<td data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->footerCellClass() ?>"><span id="elf_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->footerCellClass() ?>"><span id="elf_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->footerCellClass() ?>"><span id="elf_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->footerCellClass() ?>"><span id="elf_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<td data-name="Box" class="<?php echo $tbl_history_pick->Box->footerCellClass() ?>"><span id="elf_tbl_history_pick_Box" class="tbl_history_pick_Box">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->Box->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_history_pick_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_history_pick->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_history_pick_list->Recordset)
	$tbl_history_pick_list->Recordset->Close();
?>
<?php if (!$tbl_history_pick->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_history_pick->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_history_pick_list->Pager)) $tbl_history_pick_list->Pager = new PrevNextPager($tbl_history_pick_list->StartRec, $tbl_history_pick_list->DisplayRecs, $tbl_history_pick_list->TotalRecs, $tbl_history_pick_list->AutoHidePager) ?>
<?php if ($tbl_history_pick_list->Pager->RecordCount > 0 && $tbl_history_pick_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_history_pick_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_history_pick_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_history_pick_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_history_pick_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_history_pick_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_history_pick_list->pageUrl() ?>start=<?php echo $tbl_history_pick_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_history_pick_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_history_pick_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_history_pick_list->TotalRecs > 0 && (!$tbl_history_pick_list->AutoHidePageSizeSelector || $tbl_history_pick_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_history_pick">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_history_pick_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_history_pick_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_history_pick_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_history_pick_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_history_pick_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_history_pick->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_history_pick_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_history_pick_list->TotalRecs == 0 && !$tbl_history_pick->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_history_pick_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_history_pick_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_history_pick->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_history_pick_list->terminate();
?>