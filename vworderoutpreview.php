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
WriteHeader(FALSE, "utf-8");

// Create page object
$vworderout_preview = new vworderout_preview();

// Run the page
$vworderout_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderout_preview->Page_Render();
?>
<?php $vworderout_preview->showPageHeader(); ?>
<div class="card ew-grid vworderout"><!-- .card -->
<?php if ($vworderout_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vworderout_preview->renderListOptions();

// Render list options (header, left)
$vworderout_preview->ListOptions->render("header", "left");
?>
<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vworderout->SortUrl($vworderout->ID_Order) == "") { ?>
		<th class="<?php echo $vworderout->ID_Order->headerCellClass() ?>"><?php echo $vworderout->ID_Order->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->ID_Order->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->ID_Order->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->ID_Order->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->ID_Order->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->ID_Order->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->Code->Visible) { // Code ?>
	<?php if ($vworderout->SortUrl($vworderout->Code) == "") { ?>
		<th class="<?php echo $vworderout->Code->headerCellClass() ?>"><?php echo $vworderout->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->Code->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->Code->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->Code->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->PCS->Visible) { // PCS ?>
	<?php if ($vworderout->SortUrl($vworderout->PCS) == "") { ?>
		<th class="<?php echo $vworderout->PCS->headerCellClass() ?>"><?php echo $vworderout->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->PCS->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->PCS->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->PCS->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vworderout->SortUrl($vworderout->OrderDate) == "") { ?>
		<th class="<?php echo $vworderout->OrderDate->headerCellClass() ?>"><?php echo $vworderout->OrderDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->OrderDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->OrderDate->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->OrderDate->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->OrderDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->OrderDate->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
	<?php if ($vworderout->SortUrl($vworderout->ContactName) == "") { ?>
		<th class="<?php echo $vworderout->ContactName->headerCellClass() ?>"><?php echo $vworderout->ContactName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->ContactName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->ContactName->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->ContactName->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->ContactName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->ContactName->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vworderout->SortUrl($vworderout->CompanyName) == "") { ?>
		<th class="<?php echo $vworderout->CompanyName->headerCellClass() ?>"><?php echo $vworderout->CompanyName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->CompanyName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->CompanyName->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->CompanyName->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->CompanyName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->CompanyName->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($vworderout->SortUrl($vworderout->ContactPhone) == "") { ?>
		<th class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>"><?php echo $vworderout->ContactPhone->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->ContactPhone->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->ContactPhone->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->ContactPhone->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->ContactPhone->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<?php if ($vworderout->SortUrl($vworderout->StatusFinishOrder) == "") { ?>
		<th class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>"><?php echo $vworderout->StatusFinishOrder->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->StatusFinishOrder->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->StatusFinishOrder->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->StatusFinishOrder->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->StatusFinishOrder->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
	<?php if ($vworderout->SortUrl($vworderout->DateTimefinishOrder) == "") { ?>
		<th class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>"><?php echo $vworderout->DateTimefinishOrder->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->DateTimefinishOrder->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->DateTimefinishOrder->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->DateTimefinishOrder->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->DateTimefinishOrder->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
	<?php if ($vworderout->SortUrl($vworderout->UserFinishOrder) == "") { ?>
		<th class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>"><?php echo $vworderout->UserFinishOrder->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderout->UserFinishOrder->Name ?>" data-sort-order="<?php echo $vworderout_preview->SortField == $vworderout->UserFinishOrder->Name && $vworderout_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderout->UserFinishOrder->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderout_preview->SortField == $vworderout->UserFinishOrder->Name) { ?><?php if ($vworderout_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderout_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderout_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vworderout_preview->RecCount = 0;
$vworderout_preview->RowCnt = 0;
while ($vworderout_preview->Recordset && !$vworderout_preview->Recordset->EOF) {

	// Init row class and style
	$vworderout_preview->RecCount++;
	$vworderout_preview->RowCnt++;
	$vworderout_preview->CssStyle = "";
	$vworderout_preview->loadListRowValues($vworderout_preview->Recordset);

	// Render row
	$vworderout_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vworderout_preview->resetAttributes();
	$vworderout_preview->renderListRow();

	// Render list options
	$vworderout_preview->renderListOptions();
?>
	<tr<?php echo $vworderout_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderout_preview->ListOptions->render("body", "left", $vworderout_preview->RowCnt);
?>
<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
		<!-- ID_Order -->
		<td<?php echo $vworderout->ID_Order->cellAttributes() ?>>
<span<?php echo $vworderout->ID_Order->viewAttributes() ?>>
<?php echo $vworderout->ID_Order->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vworderout->Code->cellAttributes() ?>>
<span<?php echo $vworderout->Code->viewAttributes() ?>>
<?php echo $vworderout->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vworderout->PCS->cellAttributes() ?>>
<span<?php echo $vworderout->PCS->viewAttributes() ?>>
<?php echo $vworderout->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
		<!-- OrderDate -->
		<td<?php echo $vworderout->OrderDate->cellAttributes() ?>>
<span<?php echo $vworderout->OrderDate->viewAttributes() ?>>
<?php echo $vworderout->OrderDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
		<!-- ContactName -->
		<td<?php echo $vworderout->ContactName->cellAttributes() ?>>
<span<?php echo $vworderout->ContactName->viewAttributes() ?>>
<?php echo $vworderout->ContactName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
		<!-- CompanyName -->
		<td<?php echo $vworderout->CompanyName->cellAttributes() ?>>
<span<?php echo $vworderout->CompanyName->viewAttributes() ?>>
<?php echo $vworderout->CompanyName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
		<!-- ContactPhone -->
		<td<?php echo $vworderout->ContactPhone->cellAttributes() ?>>
<span<?php echo $vworderout->ContactPhone->viewAttributes() ?>>
<?php echo $vworderout->ContactPhone->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<!-- StatusFinishOrder -->
		<td<?php echo $vworderout->StatusFinishOrder->cellAttributes() ?>>
<span<?php echo $vworderout->StatusFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->StatusFinishOrder->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
		<!-- DateTimefinishOrder -->
		<td<?php echo $vworderout->DateTimefinishOrder->cellAttributes() ?>>
<span<?php echo $vworderout->DateTimefinishOrder->viewAttributes() ?>>
<?php echo $vworderout->DateTimefinishOrder->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
		<!-- UserFinishOrder -->
		<td<?php echo $vworderout->UserFinishOrder->cellAttributes() ?>>
<span<?php echo $vworderout->UserFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->UserFinishOrder->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vworderout_preview->ListOptions->render("body", "right", $vworderout_preview->RowCnt);
?>
	</tr>
<?php
	$vworderout_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vworderout_preview->TotalRecs > 0) { ?>
<?php if (!isset($vworderout_preview->Pager)) $vworderout_preview->Pager = new PrevNextPager($vworderout_preview->StartRec, $vworderout_preview->DisplayRecs, $vworderout_preview->TotalRecs) ?>
<?php if ($vworderout_preview->Pager->RecordCount > 0 && $vworderout_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vworderout_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vworderout_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vworderout_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vworderout_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vworderout_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vworderout_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vworderout_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vworderout_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderout_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderout_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderout_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vworderout_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vworderout_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vworderout_preview->Recordset)
	$vworderout_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vworderout_preview->terminate();
?>