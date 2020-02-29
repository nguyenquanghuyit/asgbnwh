<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_inventory
 */
class tbl_inventory extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $ID_Delivery;
	public $In_Year;
	public $In_Month;
	public $Code;
	public $ProductName;
	public $TypeName;
	public $OpeningStock;
	public $PCS_IN;
	public $PCS_OUT;
	public $ClosingStock;
	public $LockStock;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_inventory';
		$this->TableName = 'tbl_inventory';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_inventory`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// ID_Delivery
		$this->ID_Delivery = new DbField('tbl_inventory', 'tbl_inventory', 'x_ID_Delivery', 'ID_Delivery', '`ID_Delivery`', '`ID_Delivery`', 3, -1, FALSE, '`ID_Delivery`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Delivery->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Delivery->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Delivery->Sortable = TRUE; // Allow sort
		$this->ID_Delivery->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Delivery'] = &$this->ID_Delivery;

		// In_Year
		$this->In_Year = new DbField('tbl_inventory', 'tbl_inventory', 'x_In_Year', 'In_Year', '`In_Year`', '`In_Year`', 3, -1, FALSE, '`In_Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->In_Year->Nullable = FALSE; // NOT NULL field
		$this->In_Year->Required = TRUE; // Required field
		$this->In_Year->Sortable = TRUE; // Allow sort
		$this->In_Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['In_Year'] = &$this->In_Year;

		// In_Month
		$this->In_Month = new DbField('tbl_inventory', 'tbl_inventory', 'x_In_Month', 'In_Month', '`In_Month`', '`In_Month`', 3, -1, FALSE, '`In_Month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->In_Month->Nullable = FALSE; // NOT NULL field
		$this->In_Month->Required = TRUE; // Required field
		$this->In_Month->Sortable = TRUE; // Allow sort
		$this->In_Month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['In_Month'] = &$this->In_Month;

		// Code
		$this->Code = new DbField('tbl_inventory', 'tbl_inventory', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Nullable = FALSE; // NOT NULL field
		$this->Code->Required = TRUE; // Required field
		$this->Code->Sortable = TRUE; // Allow sort
		$this->fields['Code'] = &$this->Code;

		// ProductName
		$this->ProductName = new DbField('tbl_inventory', 'tbl_inventory', 'x_ProductName', 'ProductName', '`ProductName`', '`ProductName`', 200, -1, FALSE, '`ProductName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProductName->Nullable = FALSE; // NOT NULL field
		$this->ProductName->Required = TRUE; // Required field
		$this->ProductName->Sortable = TRUE; // Allow sort
		$this->fields['ProductName'] = &$this->ProductName;

		// TypeName
		$this->TypeName = new DbField('tbl_inventory', 'tbl_inventory', 'x_TypeName', 'TypeName', '`TypeName`', '`TypeName`', 200, -1, FALSE, '`TypeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->TypeName->Sortable = TRUE; // Allow sort
		$this->TypeName->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->TypeName->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->TypeName->Lookup = new Lookup('TypeName', 'tbl_inventory', TRUE, 'TypeName', ["TypeName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['TypeName'] = &$this->TypeName;

		// OpeningStock
		$this->OpeningStock = new DbField('tbl_inventory', 'tbl_inventory', 'x_OpeningStock', 'OpeningStock', '`OpeningStock`', '`OpeningStock`', 3, -1, FALSE, '`OpeningStock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OpeningStock->Sortable = TRUE; // Allow sort
		$this->OpeningStock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OpeningStock'] = &$this->OpeningStock;

		// PCS_IN
		$this->PCS_IN = new DbField('tbl_inventory', 'tbl_inventory', 'x_PCS_IN', 'PCS_IN', '`PCS_IN`', '`PCS_IN`', 3, -1, FALSE, '`PCS_IN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS_IN->Sortable = TRUE; // Allow sort
		$this->PCS_IN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS_IN'] = &$this->PCS_IN;

		// PCS_OUT
		$this->PCS_OUT = new DbField('tbl_inventory', 'tbl_inventory', 'x_PCS_OUT', 'PCS_OUT', '`PCS_OUT`', '`PCS_OUT`', 3, -1, FALSE, '`PCS_OUT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS_OUT->Sortable = TRUE; // Allow sort
		$this->PCS_OUT->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS_OUT'] = &$this->PCS_OUT;

		// ClosingStock
		$this->ClosingStock = new DbField('tbl_inventory', 'tbl_inventory', 'x_ClosingStock', 'ClosingStock', '`ClosingStock`', '`ClosingStock`', 3, -1, FALSE, '`ClosingStock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClosingStock->Sortable = TRUE; // Allow sort
		$this->ClosingStock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClosingStock'] = &$this->ClosingStock;

		// LockStock
		$this->LockStock = new DbField('tbl_inventory', 'tbl_inventory', 'x_LockStock', 'LockStock', '`LockStock`', '`LockStock`', 16, -1, FALSE, '`LockStock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->LockStock->Sortable = TRUE; // Allow sort
		$this->LockStock->Lookup = new Lookup('LockStock', 'tbl_inventory', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LockStock->OptionCount = 2;
		$this->LockStock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LockStock'] = &$this->LockStock;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_inventory`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`In_Year` DESC,`In_Month` DESC,`Code` ASC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ID_Delivery->setDbValue($conn->insert_ID());
			$rs['ID_Delivery'] = $this->ID_Delivery->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_Delivery', $rs))
				AddFilter($where, QuotedName('ID_Delivery', $this->Dbid) . '=' . QuotedValue($rs['ID_Delivery'], $this->ID_Delivery->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_Delivery->DbValue = $row['ID_Delivery'];
		$this->In_Year->DbValue = $row['In_Year'];
		$this->In_Month->DbValue = $row['In_Month'];
		$this->Code->DbValue = $row['Code'];
		$this->ProductName->DbValue = $row['ProductName'];
		$this->TypeName->DbValue = $row['TypeName'];
		$this->OpeningStock->DbValue = $row['OpeningStock'];
		$this->PCS_IN->DbValue = $row['PCS_IN'];
		$this->PCS_OUT->DbValue = $row['PCS_OUT'];
		$this->ClosingStock->DbValue = $row['ClosingStock'];
		$this->LockStock->DbValue = $row['LockStock'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Delivery` = @ID_Delivery@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Delivery', $row) ? $row['ID_Delivery'] : NULL) : $this->ID_Delivery->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Delivery@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_inventorylist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "tbl_inventoryview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_inventoryedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_inventoryadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_inventorylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_inventoryview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_inventoryview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_inventoryadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_inventoryadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_inventoryedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_inventoryadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("tbl_inventorydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Delivery:" . JsonEncode($this->ID_Delivery->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->ID_Delivery->CurrentValue != NULL) {
			$url .= "ID_Delivery=" . urlencode($this->ID_Delivery->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ID_Delivery") !== NULL)
				$arKeys[] = Param("ID_Delivery");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->ID_Delivery->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ID_Delivery->setDbValue($rs->fields('ID_Delivery'));
		$this->In_Year->setDbValue($rs->fields('In_Year'));
		$this->In_Month->setDbValue($rs->fields('In_Month'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->ProductName->setDbValue($rs->fields('ProductName'));
		$this->TypeName->setDbValue($rs->fields('TypeName'));
		$this->OpeningStock->setDbValue($rs->fields('OpeningStock'));
		$this->PCS_IN->setDbValue($rs->fields('PCS_IN'));
		$this->PCS_OUT->setDbValue($rs->fields('PCS_OUT'));
		$this->ClosingStock->setDbValue($rs->fields('ClosingStock'));
		$this->LockStock->setDbValue($rs->fields('LockStock'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Delivery

		$this->ID_Delivery->CellCssStyle = "white-space: nowrap;";

		// In_Year
		$this->In_Year->CellCssStyle = "width: 50px; white-space: nowrap;";

		// In_Month
		$this->In_Month->CellCssStyle = "width: 20px; white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "width: 100px; white-space: nowrap;";

		// ProductName
		$this->ProductName->CellCssStyle = "width: 250px; white-space: nowrap;";

		// TypeName
		$this->TypeName->CellCssStyle = "white-space: nowrap;";

		// OpeningStock
		$this->OpeningStock->CellCssStyle = "width: 10px; white-space: nowrap;";

		// PCS_IN
		$this->PCS_IN->CellCssStyle = "width: 10px; white-space: nowrap;";

		// PCS_OUT
		$this->PCS_OUT->CellCssStyle = "width: 10px; white-space: nowrap;";

		// ClosingStock
		$this->ClosingStock->CellCssStyle = "width: 10px; white-space: nowrap;";

		// LockStock
		$this->LockStock->CellCssStyle = "white-space: nowrap;";

		// ID_Delivery
		$this->ID_Delivery->ViewValue = $this->ID_Delivery->CurrentValue;
		$this->ID_Delivery->ViewCustomAttributes = "";

		// In_Year
		$this->In_Year->ViewValue = $this->In_Year->CurrentValue;
		$this->In_Year->CellCssStyle .= "text-align: center;";
		$this->In_Year->ViewCustomAttributes = "";

		// In_Month
		$this->In_Month->ViewValue = $this->In_Month->CurrentValue;
		$this->In_Month->ViewValue = FormatNumber($this->In_Month->ViewValue, 0, -2, -2, -2);
		$this->In_Month->CellCssStyle .= "text-align: center;";
		$this->In_Month->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->ViewCustomAttributes = "";

		// ProductName
		$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
		$this->ProductName->ViewCustomAttributes = "";

		// TypeName
		$arwrk = array();
		$arwrk[1] = $this->TypeName->CurrentValue;
		$this->TypeName->ViewValue = $this->TypeName->displayValue($arwrk);
		$this->TypeName->CellCssStyle .= "text-align: center;";
		$this->TypeName->ViewCustomAttributes = "";

		// OpeningStock
		$this->OpeningStock->ViewValue = $this->OpeningStock->CurrentValue;
		$this->OpeningStock->ViewValue = FormatNumber($this->OpeningStock->ViewValue, 0, -2, -2, -2);
		$this->OpeningStock->CellCssStyle .= "text-align: right;";
		$this->OpeningStock->ViewCustomAttributes = "";

		// PCS_IN
		$this->PCS_IN->ViewValue = $this->PCS_IN->CurrentValue;
		$this->PCS_IN->ViewValue = FormatNumber($this->PCS_IN->ViewValue, 0, -2, -2, -2);
		$this->PCS_IN->CellCssStyle .= "text-align: right;";
		$this->PCS_IN->ViewCustomAttributes = "";

		// PCS_OUT
		$this->PCS_OUT->ViewValue = $this->PCS_OUT->CurrentValue;
		$this->PCS_OUT->ViewValue = FormatNumber($this->PCS_OUT->ViewValue, 0, -2, -2, -2);
		$this->PCS_OUT->CellCssStyle .= "text-align: right;";
		$this->PCS_OUT->ViewCustomAttributes = "";

		// ClosingStock
		$this->ClosingStock->ViewValue = $this->ClosingStock->CurrentValue;
		$this->ClosingStock->ViewValue = FormatNumber($this->ClosingStock->ViewValue, 0, -2, -2, -2);
		$this->ClosingStock->CellCssStyle .= "text-align: right;";
		$this->ClosingStock->ViewCustomAttributes = "";

		// LockStock
		if (strval($this->LockStock->CurrentValue) <> "") {
			$this->LockStock->ViewValue = $this->LockStock->optionCaption($this->LockStock->CurrentValue);
		} else {
			$this->LockStock->ViewValue = NULL;
		}
		$this->LockStock->CellCssStyle .= "text-align: center;";
		$this->LockStock->ViewCustomAttributes = "";

		// ID_Delivery
		$this->ID_Delivery->LinkCustomAttributes = "";
		$this->ID_Delivery->HrefValue = "";
		$this->ID_Delivery->TooltipValue = "";

		// In_Year
		$this->In_Year->LinkCustomAttributes = "";
		$this->In_Year->HrefValue = "";
		$this->In_Year->TooltipValue = "";

		// In_Month
		$this->In_Month->LinkCustomAttributes = "";
		$this->In_Month->HrefValue = "";
		$this->In_Month->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// ProductName
		$this->ProductName->LinkCustomAttributes = "";
		$this->ProductName->HrefValue = "";
		$this->ProductName->TooltipValue = "";

		// TypeName
		$this->TypeName->LinkCustomAttributes = "";
		$this->TypeName->HrefValue = "";
		$this->TypeName->TooltipValue = "";

		// OpeningStock
		$this->OpeningStock->LinkCustomAttributes = "";
		$this->OpeningStock->HrefValue = "";
		$this->OpeningStock->TooltipValue = "";

		// PCS_IN
		$this->PCS_IN->LinkCustomAttributes = "";
		$this->PCS_IN->HrefValue = "";
		$this->PCS_IN->TooltipValue = "";

		// PCS_OUT
		$this->PCS_OUT->LinkCustomAttributes = "";
		$this->PCS_OUT->HrefValue = "";
		$this->PCS_OUT->TooltipValue = "";

		// ClosingStock
		$this->ClosingStock->LinkCustomAttributes = "";
		$this->ClosingStock->HrefValue = "";
		$this->ClosingStock->TooltipValue = "";

		// LockStock
		$this->LockStock->LinkCustomAttributes = "";
		$this->LockStock->HrefValue = "";
		$this->LockStock->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ID_Delivery
		$this->ID_Delivery->EditAttrs["class"] = "form-control";
		$this->ID_Delivery->EditCustomAttributes = "";
		$this->ID_Delivery->EditValue = $this->ID_Delivery->CurrentValue;
		$this->ID_Delivery->ViewCustomAttributes = "";

		// In_Year
		$this->In_Year->EditAttrs["class"] = "form-control";
		$this->In_Year->EditCustomAttributes = "";
		$this->In_Year->EditValue = $this->In_Year->CurrentValue;
		$this->In_Year->CellCssStyle .= "text-align: center;";
		$this->In_Year->ViewCustomAttributes = "";

		// In_Month
		$this->In_Month->EditAttrs["class"] = "form-control";
		$this->In_Month->EditCustomAttributes = "";
		$this->In_Month->EditValue = $this->In_Month->CurrentValue;
		$this->In_Month->EditValue = FormatNumber($this->In_Month->EditValue, 0, -2, -2, -2);
		$this->In_Month->CellCssStyle .= "text-align: center;";
		$this->In_Month->ViewCustomAttributes = "";

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->ViewCustomAttributes = "";

		// ProductName
		$this->ProductName->EditAttrs["class"] = "form-control";
		$this->ProductName->EditCustomAttributes = "";
		$this->ProductName->EditValue = $this->ProductName->CurrentValue;
		$this->ProductName->ViewCustomAttributes = "";

		// TypeName
		$this->TypeName->EditAttrs["class"] = "form-control";
		$this->TypeName->EditCustomAttributes = "";

		// OpeningStock
		$this->OpeningStock->EditAttrs["class"] = "form-control";
		$this->OpeningStock->EditCustomAttributes = "";
		$this->OpeningStock->EditValue = $this->OpeningStock->CurrentValue;
		$this->OpeningStock->EditValue = FormatNumber($this->OpeningStock->EditValue, 0, -2, -2, -2);
		$this->OpeningStock->CellCssStyle .= "text-align: right;";
		$this->OpeningStock->ViewCustomAttributes = "";

		// PCS_IN
		$this->PCS_IN->EditAttrs["class"] = "form-control";
		$this->PCS_IN->EditCustomAttributes = "";
		$this->PCS_IN->EditValue = $this->PCS_IN->CurrentValue;
		$this->PCS_IN->EditValue = FormatNumber($this->PCS_IN->EditValue, 0, -2, -2, -2);
		$this->PCS_IN->CellCssStyle .= "text-align: right;";
		$this->PCS_IN->ViewCustomAttributes = "";

		// PCS_OUT
		$this->PCS_OUT->EditAttrs["class"] = "form-control";
		$this->PCS_OUT->EditCustomAttributes = "";
		$this->PCS_OUT->EditValue = $this->PCS_OUT->CurrentValue;
		$this->PCS_OUT->EditValue = FormatNumber($this->PCS_OUT->EditValue, 0, -2, -2, -2);
		$this->PCS_OUT->CellCssStyle .= "text-align: right;";
		$this->PCS_OUT->ViewCustomAttributes = "";

		// ClosingStock
		$this->ClosingStock->EditAttrs["class"] = "form-control";
		$this->ClosingStock->EditCustomAttributes = "";
		$this->ClosingStock->EditValue = $this->ClosingStock->CurrentValue;
		$this->ClosingStock->EditValue = FormatNumber($this->ClosingStock->EditValue, 0, -2, -2, -2);
		$this->ClosingStock->CellCssStyle .= "text-align: right;";
		$this->ClosingStock->ViewCustomAttributes = "";

		// LockStock
		$this->LockStock->EditCustomAttributes = "";
		$this->LockStock->EditValue = $this->LockStock->options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->OpeningStock->CurrentValue))
				$this->OpeningStock->Total += $this->OpeningStock->CurrentValue; // Accumulate total
			if (is_numeric($this->PCS_IN->CurrentValue))
				$this->PCS_IN->Total += $this->PCS_IN->CurrentValue; // Accumulate total
			if (is_numeric($this->PCS_OUT->CurrentValue))
				$this->PCS_OUT->Total += $this->PCS_OUT->CurrentValue; // Accumulate total
			if (is_numeric($this->ClosingStock->CurrentValue))
				$this->ClosingStock->Total += $this->ClosingStock->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->OpeningStock->CurrentValue = $this->OpeningStock->Total;
			$this->OpeningStock->ViewValue = $this->OpeningStock->CurrentValue;
			$this->OpeningStock->ViewValue = FormatNumber($this->OpeningStock->ViewValue, 0, -2, -2, -2);
			$this->OpeningStock->CellCssStyle .= "text-align: right;";
			$this->OpeningStock->ViewCustomAttributes = "";
			$this->OpeningStock->HrefValue = ""; // Clear href value
			$this->PCS_IN->CurrentValue = $this->PCS_IN->Total;
			$this->PCS_IN->ViewValue = $this->PCS_IN->CurrentValue;
			$this->PCS_IN->ViewValue = FormatNumber($this->PCS_IN->ViewValue, 0, -2, -2, -2);
			$this->PCS_IN->CellCssStyle .= "text-align: right;";
			$this->PCS_IN->ViewCustomAttributes = "";
			$this->PCS_IN->HrefValue = ""; // Clear href value
			$this->PCS_OUT->CurrentValue = $this->PCS_OUT->Total;
			$this->PCS_OUT->ViewValue = $this->PCS_OUT->CurrentValue;
			$this->PCS_OUT->ViewValue = FormatNumber($this->PCS_OUT->ViewValue, 0, -2, -2, -2);
			$this->PCS_OUT->CellCssStyle .= "text-align: right;";
			$this->PCS_OUT->ViewCustomAttributes = "";
			$this->PCS_OUT->HrefValue = ""; // Clear href value
			$this->ClosingStock->CurrentValue = $this->ClosingStock->Total;
			$this->ClosingStock->ViewValue = $this->ClosingStock->CurrentValue;
			$this->ClosingStock->ViewValue = FormatNumber($this->ClosingStock->ViewValue, 0, -2, -2, -2);
			$this->ClosingStock->CellCssStyle .= "text-align: right;";
			$this->ClosingStock->ViewCustomAttributes = "";
			$this->ClosingStock->HrefValue = ""; // Clear href value

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->ID_Delivery);
					$doc->exportCaption($this->In_Year);
					$doc->exportCaption($this->In_Month);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->TypeName);
					$doc->exportCaption($this->OpeningStock);
					$doc->exportCaption($this->PCS_IN);
					$doc->exportCaption($this->PCS_OUT);
					$doc->exportCaption($this->ClosingStock);
					$doc->exportCaption($this->LockStock);
				} else {
					$doc->exportCaption($this->ID_Delivery);
					$doc->exportCaption($this->In_Year);
					$doc->exportCaption($this->In_Month);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->TypeName);
					$doc->exportCaption($this->OpeningStock);
					$doc->exportCaption($this->PCS_IN);
					$doc->exportCaption($this->PCS_OUT);
					$doc->exportCaption($this->ClosingStock);
					$doc->exportCaption($this->LockStock);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ID_Delivery);
						$doc->exportField($this->In_Year);
						$doc->exportField($this->In_Month);
						$doc->exportField($this->Code);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->TypeName);
						$doc->exportField($this->OpeningStock);
						$doc->exportField($this->PCS_IN);
						$doc->exportField($this->PCS_OUT);
						$doc->exportField($this->ClosingStock);
						$doc->exportField($this->LockStock);
					} else {
						$doc->exportField($this->ID_Delivery);
						$doc->exportField($this->In_Year);
						$doc->exportField($this->In_Month);
						$doc->exportField($this->Code);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->TypeName);
						$doc->exportField($this->OpeningStock);
						$doc->exportField($this->PCS_IN);
						$doc->exportField($this->PCS_OUT);
						$doc->exportField($this->ClosingStock);
						$doc->exportField($this->LockStock);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->ID_Delivery, '');
				$doc->exportAggregate($this->In_Year, '');
				$doc->exportAggregate($this->In_Month, '');
				$doc->exportAggregate($this->Code, '');
				$doc->exportAggregate($this->ProductName, '');
				$doc->exportAggregate($this->TypeName, '');
				$doc->exportAggregate($this->OpeningStock, 'TOTAL');
				$doc->exportAggregate($this->PCS_IN, 'TOTAL');
				$doc->exportAggregate($this->PCS_OUT, 'TOTAL');
				$doc->exportAggregate($this->ClosingStock, 'TOTAL');
				$doc->exportAggregate($this->LockStock, '');
				$doc->endExportRow();
			}
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>