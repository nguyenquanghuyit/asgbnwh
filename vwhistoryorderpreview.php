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
$vwhistoryorder_preview = new vwhistoryorder_preview();

// Run the page
$vwhistoryorder_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryorder_preview->Page_Render();
?>
<?php $vwhistoryorder_preview->showPageHeader(); ?>
<div class="card ew-grid vwhistoryorder"><!-- .card -->
<?php if ($vwhistoryorder_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vwhistoryorder_preview->renderListOptions();

// Render list options (header, left)
$vwhistoryorder_preview->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->PalletID) == "") { ?>
		<th class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>"><?php echo $vwhistoryorder->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->PalletID->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->PalletID->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->PalletID->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->Code) == "") { ?>
		<th class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>"><?php echo $vwhistoryorder->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->Code->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->Code->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->Code->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->ProductName) == "") { ?>
		<th class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>"><?php echo $vwhistoryorder->ProductName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->ProductName->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->ProductName->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->ProductName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->ProductName->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->PCS_Out) == "") { ?>
		<th class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>"><?php echo $vwhistoryorder->PCS_Out->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->PCS_Out->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->PCS_Out->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->PCS_Out->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->PCS_Out->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->DateIn) == "") { ?>
		<th class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>"><?php echo $vwhistoryorder->DateIn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->DateIn->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->DateIn->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateIn->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->DateIn->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->DateOut) == "") { ?>
		<th class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>"><?php echo $vwhistoryorder->DateOut->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->DateOut->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->DateOut->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateOut->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->DateOut->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->PalletStatus) == "") { ?>
		<th class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>"><?php echo $vwhistoryorder->PalletStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->PalletStatus->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->PalletStatus->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletStatus->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->PalletStatus->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryorder->SortUrl($vwhistoryorder->CreateUser) == "") { ?>
		<th class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>"><?php echo $vwhistoryorder->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryorder->CreateUser->Name ?>" data-sort-order="<?php echo $vwhistoryorder_preview->SortField == $vwhistoryorder->CreateUser->Name && $vwhistoryorder_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryorder->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryorder_preview->SortField == $vwhistoryorder->CreateUser->Name) { ?><?php if ($vwhistoryorder_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryorder_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryorder_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vwhistoryorder_preview->RecCount = 0;
$vwhistoryorder_preview->RowCnt = 0;
while ($vwhistoryorder_preview->Recordset && !$vwhistoryorder_preview->Recordset->EOF) {

	// Init row class and style
	$vwhistoryorder_preview->RecCount++;
	$vwhistoryorder_preview->RowCnt++;
	$vwhistoryorder_preview->CssStyle = "";
	$vwhistoryorder_preview->loadListRowValues($vwhistoryorder_preview->Recordset);
	$vwhistoryorder_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$vwhistoryorder_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vwhistoryorder_preview->resetAttributes();
	$vwhistoryorder_preview->renderListRow();

	// Render list options
	$vwhistoryorder_preview->renderListOptions();
?>
	<tr<?php echo $vwhistoryorder_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryorder_preview->ListOptions->render("body", "left", $vwhistoryorder_preview->RowCnt);
?>
<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $vwhistoryorder->PalletID->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vwhistoryorder->Code->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->Code->viewAttributes() ?>>
<?php echo $vwhistoryorder->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<!-- ProductName -->
		<td<?php echo $vwhistoryorder->ProductName->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->ProductName->viewAttributes() ?>>
<?php echo $vwhistoryorder->ProductName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<!-- PCS_Out -->
		<td<?php echo $vwhistoryorder->PCS_Out->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->PCS_Out->viewAttributes() ?>>
<?php echo $vwhistoryorder->PCS_Out->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td<?php echo $vwhistoryorder->DateIn->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->DateIn->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateIn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<!-- DateOut -->
		<td<?php echo $vwhistoryorder->DateOut->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->DateOut->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateOut->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<!-- PalletStatus -->
		<td<?php echo $vwhistoryorder->PalletStatus->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->PalletStatus->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $vwhistoryorder->CreateUser->cellAttributes() ?>>
<span<?php echo $vwhistoryorder->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryorder->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryorder_preview->ListOptions->render("body", "right", $vwhistoryorder_preview->RowCnt);
?>
	</tr>
<?php
	$vwhistoryorder_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$vwhistoryorder_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$vwhistoryorder_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$vwhistoryorder_preview->ListOptions->render("footer", "left");
?>
<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td class="<?php echo $vwhistoryorder->PalletID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $vwhistoryorder->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<!-- ProductName -->
		<td class="<?php echo $vwhistoryorder->ProductName->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<!-- PCS_Out -->
		<td class="<?php echo $vwhistoryorder->PCS_Out->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwhistoryorder->PCS_Out->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td class="<?php echo $vwhistoryorder->DateIn->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<!-- DateOut -->
		<td class="<?php echo $vwhistoryorder->DateOut->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<!-- PalletStatus -->
		<td class="<?php echo $vwhistoryorder->PalletStatus->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td class="<?php echo $vwhistoryorder->CreateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$vwhistoryorder_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vwhistoryorder_preview->TotalRecs > 0) { ?>
<?php if (!isset($vwhistoryorder_preview->Pager)) $vwhistoryorder_preview->Pager = new PrevNextPager($vwhistoryorder_preview->StartRec, $vwhistoryorder_preview->DisplayRecs, $vwhistoryorder_preview->TotalRecs) ?>
<?php if ($vwhistoryorder_preview->Pager->RecordCount > 0 && $vwhistoryorder_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vwhistoryorder_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vwhistoryorder_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vwhistoryorder_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vwhistoryorder_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vwhistoryorder_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vwhistoryorder_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vwhistoryorder_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vwhistoryorder_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryorder_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryorder_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryorder_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vwhistoryorder_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vwhistoryorder_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vwhistoryorder_preview->Recordset)
	$vwhistoryorder_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vwhistoryorder_preview->terminate();
?>