<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for vwrouteout
 */
class vwrouteout extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $ID_Route;
	public $RouteName;
	public $TruckNo;
	public $DriverName;
	public $DriverMobile;
	public $InvoiceNo;
	public $InvoiceDate;
	public $CreateUser;
	public $CreateDate;
	public $UpdateUser;
	public $UpdateDate;
	public $InOrOut;
	public $FinishUnload;
	public $SealNo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'vwrouteout';
		$this->TableName = 'vwrouteout';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`vwrouteout`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// ID_Route
		$this->ID_Route = new DbField('vwrouteout', 'vwrouteout', 'x_ID_Route', 'ID_Route', '`ID_Route`', '`ID_Route`', 3, -1, FALSE, '`ID_Route`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Route->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Route->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Route->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Route->Sortable = FALSE; // Allow sort
		$this->ID_Route->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Route'] = &$this->ID_Route;

		// RouteName
		$this->RouteName = new DbField('vwrouteout', 'vwrouteout', 'x_RouteName', 'RouteName', '`RouteName`', '`RouteName`', 200, -1, FALSE, '`RouteName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RouteName->Sortable = TRUE; // Allow sort
		$this->RouteName->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RouteName->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->RouteName->Lookup = new Lookup('RouteName', 'vwrouteout', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->RouteName->OptionCount = 1;
		$this->fields['RouteName'] = &$this->RouteName;

		// TruckNo
		$this->TruckNo = new DbField('vwrouteout', 'vwrouteout', 'x_TruckNo', 'TruckNo', '`TruckNo`', '`TruckNo`', 200, -1, FALSE, '`TruckNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TruckNo->Nullable = FALSE; // NOT NULL field
		$this->TruckNo->Required = TRUE; // Required field
		$this->TruckNo->Sortable = TRUE; // Allow sort
		$this->fields['TruckNo'] = &$this->TruckNo;

		// DriverName
		$this->DriverName = new DbField('vwrouteout', 'vwrouteout', 'x_DriverName', 'DriverName', '`DriverName`', '`DriverName`', 200, -1, FALSE, '`DriverName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DriverName->Sortable = TRUE; // Allow sort
		$this->fields['DriverName'] = &$this->DriverName;

		// DriverMobile
		$this->DriverMobile = new DbField('vwrouteout', 'vwrouteout', 'x_DriverMobile', 'DriverMobile', '`DriverMobile`', '`DriverMobile`', 200, -1, FALSE, '`DriverMobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DriverMobile->Sortable = TRUE; // Allow sort
		$this->fields['DriverMobile'] = &$this->DriverMobile;

		// InvoiceNo
		$this->InvoiceNo = new DbField('vwrouteout', 'vwrouteout', 'x_InvoiceNo', 'InvoiceNo', '`InvoiceNo`', '`InvoiceNo`', 200, -1, FALSE, '`InvoiceNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InvoiceNo->Sortable = TRUE; // Allow sort
		$this->fields['InvoiceNo'] = &$this->InvoiceNo;

		// InvoiceDate
		$this->InvoiceDate = new DbField('vwrouteout', 'vwrouteout', 'x_InvoiceDate', 'InvoiceDate', '`InvoiceDate`', CastDateFieldForLike('`InvoiceDate`', 7, "DB"), 133, 7, FALSE, '`InvoiceDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InvoiceDate->Sortable = TRUE; // Allow sort
		$this->InvoiceDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['InvoiceDate'] = &$this->InvoiceDate;

		// CreateUser
		$this->CreateUser = new DbField('vwrouteout', 'vwrouteout', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('vwrouteout', 'vwrouteout', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 11, "DB"), 135, 11, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// UpdateUser
		$this->UpdateUser = new DbField('vwrouteout', 'vwrouteout', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// UpdateDate
		$this->UpdateDate = new DbField('vwrouteout', 'vwrouteout', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 0, "DB"), 135, 0, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;

		// InOrOut
		$this->InOrOut = new DbField('vwrouteout', 'vwrouteout', 'x_InOrOut', 'InOrOut', '`InOrOut`', '`InOrOut`', 200, -1, FALSE, '`InOrOut`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InOrOut->Sortable = FALSE; // Allow sort
		$this->fields['InOrOut'] = &$this->InOrOut;

		// FinishUnload
		$this->FinishUnload = new DbField('vwrouteout', 'vwrouteout', 'x_FinishUnload', 'FinishUnload', '`FinishUnload`', '`FinishUnload`', 16, -1, FALSE, '`FinishUnload`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FinishUnload->Sortable = FALSE; // Allow sort
		$this->FinishUnload->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FinishUnload->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->FinishUnload->Lookup = new Lookup('FinishUnload', 'vwrouteout', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->FinishUnload->OptionCount = 2;
		$this->FinishUnload->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinishUnload'] = &$this->FinishUnload;

		// SealNo
		$this->SealNo = new DbField('vwrouteout', 'vwrouteout', 'x_SealNo', 'SealNo', '`SealNo`', '`SealNo`', 200, -1, FALSE, '`SealNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SealNo->Sortable = TRUE; // Allow sort
		$this->fields['SealNo'] = &$this->SealNo;
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

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "tbl_loading") {
			$detailUrl = $GLOBALS["tbl_loading"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Route=" . urlencode($this->ID_Route->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "vwrouteoutlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`vwrouteout`";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`CreateDate` DESC";
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
			$this->ID_Route->setDbValue($conn->insert_ID());
			$rs['ID_Route'] = $this->ID_Route->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_Route';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_Route', $rs))
				AddFilter($where, QuotedName('ID_Route', $this->Dbid) . '=' . QuotedValue($rs['ID_Route'], $this->ID_Route->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_Route->DbValue = $row['ID_Route'];
		$this->RouteName->DbValue = $row['RouteName'];
		$this->TruckNo->DbValue = $row['TruckNo'];
		$this->DriverName->DbValue = $row['DriverName'];
		$this->DriverMobile->DbValue = $row['DriverMobile'];
		$this->InvoiceNo->DbValue = $row['InvoiceNo'];
		$this->InvoiceDate->DbValue = $row['InvoiceDate'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
		$this->InOrOut->DbValue = $row['InOrOut'];
		$this->FinishUnload->DbValue = $row['FinishUnload'];
		$this->SealNo->DbValue = $row['SealNo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Route` = @ID_Route@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Route', $row) ? $row['ID_Route'] : NULL) : $this->ID_Route->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Route@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "vwrouteoutlist.php";
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
		if ($pageName == "vwrouteoutview.php")
			return $Language->phrase("View");
		elseif ($pageName == "vwrouteoutedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "vwrouteoutadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "vwrouteoutlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("vwrouteoutview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vwrouteoutview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "vwrouteoutadd.php?" . $this->getUrlParm($parm);
		else
			$url = "vwrouteoutadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("vwrouteoutedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vwrouteoutedit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
		if ($parm <> "")
			$url = $this->keyUrl("vwrouteoutadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vwrouteoutadd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
		return $this->keyUrl("vwrouteoutdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Route:" . JsonEncode($this->ID_Route->CurrentValue, "number");
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
		if ($this->ID_Route->CurrentValue != NULL) {
			$url .= "ID_Route=" . urlencode($this->ID_Route->CurrentValue);
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
			if (Param("ID_Route") !== NULL)
				$arKeys[] = Param("ID_Route");
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
			$this->ID_Route->CurrentValue = $key;
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
		$this->ID_Route->setDbValue($rs->fields('ID_Route'));
		$this->RouteName->setDbValue($rs->fields('RouteName'));
		$this->TruckNo->setDbValue($rs->fields('TruckNo'));
		$this->DriverName->setDbValue($rs->fields('DriverName'));
		$this->DriverMobile->setDbValue($rs->fields('DriverMobile'));
		$this->InvoiceNo->setDbValue($rs->fields('InvoiceNo'));
		$this->InvoiceDate->setDbValue($rs->fields('InvoiceDate'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
		$this->InOrOut->setDbValue($rs->fields('InOrOut'));
		$this->FinishUnload->setDbValue($rs->fields('FinishUnload'));
		$this->SealNo->setDbValue($rs->fields('SealNo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Route

		$this->ID_Route->CellCssStyle = "white-space: nowrap;";

		// RouteName
		$this->RouteName->CellCssStyle = "white-space: nowrap;";

		// TruckNo
		$this->TruckNo->CellCssStyle = "white-space: nowrap;";

		// DriverName
		$this->DriverName->CellCssStyle = "white-space: nowrap;";

		// DriverMobile
		$this->DriverMobile->CellCssStyle = "white-space: nowrap;";

		// InvoiceNo
		$this->InvoiceNo->CellCssStyle = "white-space: nowrap;";

		// InvoiceDate
		$this->InvoiceDate->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// InOrOut
		$this->InOrOut->CellCssStyle = "white-space: nowrap;";

		// FinishUnload
		$this->FinishUnload->CellCssStyle = "white-space: nowrap;";

		// SealNo
		// ID_Route

		$this->ID_Route->ViewValue = $this->ID_Route->CurrentValue;
		$this->ID_Route->ViewCustomAttributes = "";

		// RouteName
		if (strval($this->RouteName->CurrentValue) <> "") {
			$this->RouteName->ViewValue = $this->RouteName->optionCaption($this->RouteName->CurrentValue);
		} else {
			$this->RouteName->ViewValue = NULL;
		}
		$this->RouteName->CellCssStyle .= "text-align: center;";
		$this->RouteName->ViewCustomAttributes = "";

		// TruckNo
		$this->TruckNo->ViewValue = $this->TruckNo->CurrentValue;
		$this->TruckNo->ViewCustomAttributes = "";

		// DriverName
		$this->DriverName->ViewValue = $this->DriverName->CurrentValue;
		$this->DriverName->ViewCustomAttributes = "";

		// DriverMobile
		$this->DriverMobile->ViewValue = $this->DriverMobile->CurrentValue;
		$this->DriverMobile->ViewCustomAttributes = "";

		// InvoiceNo
		$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->ViewCustomAttributes = "";

		// InvoiceDate
		$this->InvoiceDate->ViewValue = $this->InvoiceDate->CurrentValue;
		$this->InvoiceDate->ViewValue = FormatDateTime($this->InvoiceDate->ViewValue, 7);
		$this->InvoiceDate->CellCssStyle .= "text-align: center;";
		$this->InvoiceDate->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
		$this->CreateDate->CellCssStyle .= "text-align: center;";
		$this->CreateDate->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
		$this->UpdateDate->ViewCustomAttributes = "";

		// InOrOut
		$this->InOrOut->ViewValue = $this->InOrOut->CurrentValue;
		$this->InOrOut->ViewCustomAttributes = "";

		// FinishUnload
		if (strval($this->FinishUnload->CurrentValue) <> "") {
			$this->FinishUnload->ViewValue = $this->FinishUnload->optionCaption($this->FinishUnload->CurrentValue);
		} else {
			$this->FinishUnload->ViewValue = NULL;
		}
		$this->FinishUnload->CellCssStyle .= "text-align: center;";
		$this->FinishUnload->ViewCustomAttributes = "";

		// SealNo
		$this->SealNo->ViewValue = $this->SealNo->CurrentValue;
		$this->SealNo->ViewCustomAttributes = "";

		// ID_Route
		$this->ID_Route->LinkCustomAttributes = "";
		$this->ID_Route->HrefValue = "";
		$this->ID_Route->TooltipValue = "";

		// RouteName
		$this->RouteName->LinkCustomAttributes = "";
		$this->RouteName->HrefValue = "";
		$this->RouteName->TooltipValue = "";

		// TruckNo
		$this->TruckNo->LinkCustomAttributes = "";
		$this->TruckNo->HrefValue = "";
		$this->TruckNo->TooltipValue = "";

		// DriverName
		$this->DriverName->LinkCustomAttributes = "";
		$this->DriverName->HrefValue = "";
		$this->DriverName->TooltipValue = "";

		// DriverMobile
		$this->DriverMobile->LinkCustomAttributes = "";
		$this->DriverMobile->HrefValue = "";
		$this->DriverMobile->TooltipValue = "";

		// InvoiceNo
		$this->InvoiceNo->LinkCustomAttributes = "";
		$this->InvoiceNo->HrefValue = "";
		$this->InvoiceNo->TooltipValue = "";

		// InvoiceDate
		$this->InvoiceDate->LinkCustomAttributes = "";
		$this->InvoiceDate->HrefValue = "";
		$this->InvoiceDate->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// InOrOut
		$this->InOrOut->LinkCustomAttributes = "";
		$this->InOrOut->HrefValue = "";
		$this->InOrOut->TooltipValue = "";

		// FinishUnload
		$this->FinishUnload->LinkCustomAttributes = "";
		$this->FinishUnload->HrefValue = "";
		$this->FinishUnload->TooltipValue = "";

		// SealNo
		$this->SealNo->LinkCustomAttributes = "";
		$this->SealNo->HrefValue = "";
		$this->SealNo->TooltipValue = "";

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

		// ID_Route
		$this->ID_Route->EditAttrs["class"] = "form-control";
		$this->ID_Route->EditCustomAttributes = "";
		$this->ID_Route->EditValue = $this->ID_Route->CurrentValue;
		$this->ID_Route->ViewCustomAttributes = "";

		// RouteName
		$this->RouteName->EditAttrs["class"] = "form-control";
		$this->RouteName->EditCustomAttributes = "";
		$this->RouteName->EditValue = $this->RouteName->options(TRUE);

		// TruckNo
		$this->TruckNo->EditAttrs["class"] = "form-control";
		$this->TruckNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->TruckNo->CurrentValue = HtmlDecode($this->TruckNo->CurrentValue);
		$this->TruckNo->EditValue = $this->TruckNo->CurrentValue;
		$this->TruckNo->PlaceHolder = RemoveHtml($this->TruckNo->caption());

		// DriverName
		$this->DriverName->EditAttrs["class"] = "form-control";
		$this->DriverName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->DriverName->CurrentValue = HtmlDecode($this->DriverName->CurrentValue);
		$this->DriverName->EditValue = $this->DriverName->CurrentValue;
		$this->DriverName->PlaceHolder = RemoveHtml($this->DriverName->caption());

		// DriverMobile
		$this->DriverMobile->EditAttrs["class"] = "form-control";
		$this->DriverMobile->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->DriverMobile->CurrentValue = HtmlDecode($this->DriverMobile->CurrentValue);
		$this->DriverMobile->EditValue = $this->DriverMobile->CurrentValue;
		$this->DriverMobile->PlaceHolder = RemoveHtml($this->DriverMobile->caption());

		// InvoiceNo
		$this->InvoiceNo->EditAttrs["class"] = "form-control";
		$this->InvoiceNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
		$this->InvoiceNo->EditValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

		// InvoiceDate
		$this->InvoiceDate->EditAttrs["class"] = "form-control";
		$this->InvoiceDate->EditCustomAttributes = "";
		$this->InvoiceDate->EditValue = FormatDateTime($this->InvoiceDate->CurrentValue, 7);
		$this->InvoiceDate->PlaceHolder = RemoveHtml($this->InvoiceDate->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

		// UpdateUser
		// UpdateDate
		// InOrOut

		$this->InOrOut->EditAttrs["class"] = "form-control";
		$this->InOrOut->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->InOrOut->CurrentValue = HtmlDecode($this->InOrOut->CurrentValue);
		$this->InOrOut->EditValue = $this->InOrOut->CurrentValue;
		$this->InOrOut->PlaceHolder = RemoveHtml($this->InOrOut->caption());

		// FinishUnload
		$this->FinishUnload->EditAttrs["class"] = "form-control";
		$this->FinishUnload->EditCustomAttributes = "";
		$this->FinishUnload->EditValue = $this->FinishUnload->options(TRUE);

		// SealNo
		$this->SealNo->EditAttrs["class"] = "form-control";
		$this->SealNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->SealNo->CurrentValue = HtmlDecode($this->SealNo->CurrentValue);
		$this->SealNo->EditValue = $this->SealNo->CurrentValue;
		$this->SealNo->PlaceHolder = RemoveHtml($this->SealNo->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

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
					$doc->exportCaption($this->RouteName);
					$doc->exportCaption($this->TruckNo);
					$doc->exportCaption($this->DriverName);
					$doc->exportCaption($this->DriverMobile);
					$doc->exportCaption($this->InvoiceNo);
					$doc->exportCaption($this->InvoiceDate);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->SealNo);
				} else {
					$doc->exportCaption($this->RouteName);
					$doc->exportCaption($this->TruckNo);
					$doc->exportCaption($this->DriverName);
					$doc->exportCaption($this->DriverMobile);
					$doc->exportCaption($this->InvoiceNo);
					$doc->exportCaption($this->InvoiceDate);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->SealNo);
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

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->RouteName);
						$doc->exportField($this->TruckNo);
						$doc->exportField($this->DriverName);
						$doc->exportField($this->DriverMobile);
						$doc->exportField($this->InvoiceNo);
						$doc->exportField($this->InvoiceDate);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->SealNo);
					} else {
						$doc->exportField($this->RouteName);
						$doc->exportField($this->TruckNo);
						$doc->exportField($this->DriverName);
						$doc->exportField($this->DriverMobile);
						$doc->exportField($this->InvoiceNo);
						$doc->exportField($this->InvoiceDate);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->SealNo);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'vwrouteout';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'vwrouteout';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Route'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'vwrouteout';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_Route'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'vwrouteout';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Route'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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