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
$vwRouteUnload_preview = new vwRouteUnload_preview();

// Run the page
$vwRouteUnload_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwRouteUnload_preview->Page_Render();
?>
<?php $vwRouteUnload_preview->showPageHeader(); ?>
<div class="card ew-grid vwRouteUnload"><!-- .card -->
<?php if ($vwRouteUnload_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vwRouteUnload_preview->renderListOptions();

// Render list options (header, left)
$vwRouteUnload_preview->ListOptions->render("header", "left");
?>
<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->PalletID) == "") { ?>
		<th class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><?php echo $vwRouteUnload->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->PalletID->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->PalletID->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->PalletID->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->Code) == "") { ?>
		<th class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><?php echo $vwRouteUnload->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->Code->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->Code->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->Code->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->PCS) == "") { ?>
		<th class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><?php echo $vwRouteUnload->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->PCS->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->PCS->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->PCS->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->PcsReal) == "") { ?>
		<th class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><?php echo $vwRouteUnload->PcsReal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->PcsReal->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->PcsReal->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->PcsReal->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->PcsReal->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->CreateUser) == "") { ?>
		<th class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><?php echo $vwRouteUnload->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->CreateUser->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->CreateUser->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->CreateUser->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->CreateDate) == "") { ?>
		<th class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><?php echo $vwRouteUnload->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->CreateDate->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->CreateDate->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->CreateDate->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->MFG) == "") { ?>
		<th class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><?php echo $vwRouteUnload->MFG->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->MFG->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->MFG->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->MFG->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->MFG->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
	<?php if ($vwRouteUnload->SortUrl($vwRouteUnload->Description) == "") { ?>
		<th class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><?php echo $vwRouteUnload->Description->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwRouteUnload->Description->Name ?>" data-sort-order="<?php echo $vwRouteUnload_preview->SortField == $vwRouteUnload->Description->Name && $vwRouteUnload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwRouteUnload->Description->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwRouteUnload_preview->SortField == $vwRouteUnload->Description->Name) { ?><?php if ($vwRouteUnload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwRouteUnload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwRouteUnload_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vwRouteUnload_preview->RecCount = 0;
$vwRouteUnload_preview->RowCnt = 0;
while ($vwRouteUnload_preview->Recordset && !$vwRouteUnload_preview->Recordset->EOF) {

	// Init row class and style
	$vwRouteUnload_preview->RecCount++;
	$vwRouteUnload_preview->RowCnt++;
	$vwRouteUnload_preview->CssStyle = "";
	$vwRouteUnload_preview->loadListRowValues($vwRouteUnload_preview->Recordset);
	$vwRouteUnload_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$vwRouteUnload_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vwRouteUnload_preview->resetAttributes();
	$vwRouteUnload_preview->renderListRow();

	// Render list options
	$vwRouteUnload_preview->renderListOptions();
?>
	<tr<?php echo $vwRouteUnload_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwRouteUnload_preview->ListOptions->render("body", "left", $vwRouteUnload_preview->RowCnt);
?>
<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $vwRouteUnload->PalletID->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->PalletID->viewAttributes() ?>>
<?php echo $vwRouteUnload->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vwRouteUnload->Code->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->Code->viewAttributes() ?>>
<?php echo $vwRouteUnload->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vwRouteUnload->PCS->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->PCS->viewAttributes() ?>>
<?php echo $vwRouteUnload->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<!-- PcsReal -->
		<td<?php echo $vwRouteUnload->PcsReal->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->PcsReal->viewAttributes() ?>>
<?php echo $vwRouteUnload->PcsReal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $vwRouteUnload->CreateUser->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->CreateUser->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $vwRouteUnload->CreateDate->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->CreateDate->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<!-- MFG -->
		<td<?php echo $vwRouteUnload->MFG->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->MFG->viewAttributes() ?>>
<?php echo $vwRouteUnload->MFG->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<!-- Description -->
		<td<?php echo $vwRouteUnload->Description->cellAttributes() ?>>
<span<?php echo $vwRouteUnload->Description->viewAttributes() ?>>
<?php echo $vwRouteUnload->Description->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vwRouteUnload_preview->ListOptions->render("body", "right", $vwRouteUnload_preview->RowCnt);
?>
	</tr>
<?php
	$vwRouteUnload_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$vwRouteUnload_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$vwRouteUnload_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$vwRouteUnload_preview->ListOptions->render("footer", "left");
?>
<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td class="<?php echo $vwRouteUnload->PalletID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $vwRouteUnload->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td class="<?php echo $vwRouteUnload->PCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<!-- PcsReal -->
		<td class="<?php echo $vwRouteUnload->PcsReal->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PcsReal->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td class="<?php echo $vwRouteUnload->CreateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td class="<?php echo $vwRouteUnload->CreateDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<!-- MFG -->
		<td class="<?php echo $vwRouteUnload->MFG->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<!-- Description -->
		<td class="<?php echo $vwRouteUnload->Description->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$vwRouteUnload_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vwRouteUnload_preview->TotalRecs > 0) { ?>
<?php if (!isset($vwRouteUnload_preview->Pager)) $vwRouteUnload_preview->Pager = new PrevNextPager($vwRouteUnload_preview->StartRec, $vwRouteUnload_preview->DisplayRecs, $vwRouteUnload_preview->TotalRecs) ?>
<?php if ($vwRouteUnload_preview->Pager->RecordCount > 0 && $vwRouteUnload_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vwRouteUnload_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vwRouteUnload_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vwRouteUnload_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vwRouteUnload_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vwRouteUnload_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vwRouteUnload_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vwRouteUnload_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vwRouteUnload_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwRouteUnload_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwRouteUnload_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwRouteUnload_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vwRouteUnload_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vwRouteUnload_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vwRouteUnload_preview->Recordset)
	$vwRouteUnload_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vwRouteUnload_preview->terminate();
?>