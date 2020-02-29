<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_inventory_add extends tbl_inventory
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_inventory';

	// Page object name
	public $PageObjName = "tbl_inventory_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_inventory)
		if (!isset($GLOBALS["tbl_inventory"]) || get_class($GLOBALS["tbl_inventory"]) == PROJECT_NAMESPACE . "tbl_inventory") {
			$GLOBALS["tbl_inventory"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_inventory"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_inventory');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (tbl_user)
		if (!isset($UserTable)) {
			$UserTable = new tbl_user();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $tbl_inventory;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_inventory);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "tbl_inventoryview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ID_Delivery'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ID_Delivery->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_inventorylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID_Delivery->Visible = FALSE;
		$this->In_Year->setVisibility();
		$this->In_Month->setVisibility();
		$this->Code->setVisibility();
		$this->ProductName->setVisibility();
		$this->OpeningStock->setVisibility();
		$this->PCS_IN->setVisibility();
		$this->PCS_OUT->setVisibility();
		$this->ClosingStock->setVisibility();
		$this->LockStock->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ID_Delivery") !== NULL) {
				$this->ID_Delivery->setQueryStringValue(Get("ID_Delivery"));
				$this->setKey("ID_Delivery", $this->ID_Delivery->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Delivery", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("tbl_inventorylist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_inventorylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_inventoryview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_Delivery->CurrentValue = NULL;
		$this->ID_Delivery->OldValue = $this->ID_Delivery->CurrentValue;
		$this->In_Year->CurrentValue = NULL;
		$this->In_Year->OldValue = $this->In_Year->CurrentValue;
		$this->In_Month->CurrentValue = NULL;
		$this->In_Month->OldValue = $this->In_Month->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->ProductName->CurrentValue = NULL;
		$this->ProductName->OldValue = $this->ProductName->CurrentValue;
		$this->OpeningStock->CurrentValue = 0;
		$this->PCS_IN->CurrentValue = 0;
		$this->PCS_OUT->CurrentValue = 0;
		$this->ClosingStock->CurrentValue = NULL;
		$this->ClosingStock->OldValue = $this->ClosingStock->CurrentValue;
		$this->LockStock->CurrentValue = 0;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'In_Year' first before field var 'x_In_Year'
		$val = $CurrentForm->hasValue("In_Year") ? $CurrentForm->getValue("In_Year") : $CurrentForm->getValue("x_In_Year");
		if (!$this->In_Year->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->In_Year->Visible = FALSE; // Disable update for API request
			else
				$this->In_Year->setFormValue($val);
		}

		// Check field name 'In_Month' first before field var 'x_In_Month'
		$val = $CurrentForm->hasValue("In_Month") ? $CurrentForm->getValue("In_Month") : $CurrentForm->getValue("x_In_Month");
		if (!$this->In_Month->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->In_Month->Visible = FALSE; // Disable update for API request
			else
				$this->In_Month->setFormValue($val);
		}

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}

		// Check field name 'ProductName' first before field var 'x_ProductName'
		$val = $CurrentForm->hasValue("ProductName") ? $CurrentForm->getValue("ProductName") : $CurrentForm->getValue("x_ProductName");
		if (!$this->ProductName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ProductName->Visible = FALSE; // Disable update for API request
			else
				$this->ProductName->setFormValue($val);
		}

		// Check field name 'OpeningStock' first before field var 'x_OpeningStock'
		$val = $CurrentForm->hasValue("OpeningStock") ? $CurrentForm->getValue("OpeningStock") : $CurrentForm->getValue("x_OpeningStock");
		if (!$this->OpeningStock->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->OpeningStock->Visible = FALSE; // Disable update for API request
			else
				$this->OpeningStock->setFormValue($val);
		}

		// Check field name 'PCS_IN' first before field var 'x_PCS_IN'
		$val = $CurrentForm->hasValue("PCS_IN") ? $CurrentForm->getValue("PCS_IN") : $CurrentForm->getValue("x_PCS_IN");
		if (!$this->PCS_IN->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_IN->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_IN->setFormValue($val);
		}

		// Check field name 'PCS_OUT' first before field var 'x_PCS_OUT'
		$val = $CurrentForm->hasValue("PCS_OUT") ? $CurrentForm->getValue("PCS_OUT") : $CurrentForm->getValue("x_PCS_OUT");
		if (!$this->PCS_OUT->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_OUT->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_OUT->setFormValue($val);
		}

		// Check field name 'ClosingStock' first before field var 'x_ClosingStock'
		$val = $CurrentForm->hasValue("ClosingStock") ? $CurrentForm->getValue("ClosingStock") : $CurrentForm->getValue("x_ClosingStock");
		if (!$this->ClosingStock->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ClosingStock->Visible = FALSE; // Disable update for API request
			else
				$this->ClosingStock->setFormValue($val);
		}

		// Check field name 'LockStock' first before field var 'x_LockStock'
		$val = $CurrentForm->hasValue("LockStock") ? $CurrentForm->getValue("LockStock") : $CurrentForm->getValue("x_LockStock");
		if (!$this->LockStock->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LockStock->Visible = FALSE; // Disable update for API request
			else
				$this->LockStock->setFormValue($val);
		}

		// Check field name 'ID_Delivery' first before field var 'x_ID_Delivery'
		$val = $CurrentForm->hasValue("ID_Delivery") ? $CurrentForm->getValue("ID_Delivery") : $CurrentForm->getValue("x_ID_Delivery");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->In_Year->CurrentValue = $this->In_Year->FormValue;
		$this->In_Month->CurrentValue = $this->In_Month->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->ProductName->CurrentValue = $this->ProductName->FormValue;
		$this->OpeningStock->CurrentValue = $this->OpeningStock->FormValue;
		$this->PCS_IN->CurrentValue = $this->PCS_IN->FormValue;
		$this->PCS_OUT->CurrentValue = $this->PCS_OUT->FormValue;
		$this->ClosingStock->CurrentValue = $this->ClosingStock->FormValue;
		$this->LockStock->CurrentValue = $this->LockStock->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ID_Delivery->setDbValue($row['ID_Delivery']);
		$this->In_Year->setDbValue($row['In_Year']);
		$this->In_Month->setDbValue($row['In_Month']);
		$this->Code->setDbValue($row['Code']);
		$this->ProductName->setDbValue($row['ProductName']);
		$this->OpeningStock->setDbValue($row['OpeningStock']);
		$this->PCS_IN->setDbValue($row['PCS_IN']);
		$this->PCS_OUT->setDbValue($row['PCS_OUT']);
		$this->ClosingStock->setDbValue($row['ClosingStock']);
		$this->LockStock->setDbValue($row['LockStock']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Delivery'] = $this->ID_Delivery->CurrentValue;
		$row['In_Year'] = $this->In_Year->CurrentValue;
		$row['In_Month'] = $this->In_Month->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['ProductName'] = $this->ProductName->CurrentValue;
		$row['OpeningStock'] = $this->OpeningStock->CurrentValue;
		$row['PCS_IN'] = $this->PCS_IN->CurrentValue;
		$row['PCS_OUT'] = $this->PCS_OUT->CurrentValue;
		$row['ClosingStock'] = $this->ClosingStock->CurrentValue;
		$row['LockStock'] = $this->LockStock->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Delivery")) <> "")
			$this->ID_Delivery->CurrentValue = $this->getKey("ID_Delivery"); // ID_Delivery
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_Delivery
		// In_Year
		// In_Month
		// Code
		// ProductName
		// OpeningStock
		// PCS_IN
		// PCS_OUT
		// ClosingStock
		// LockStock

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Delivery
			$this->ID_Delivery->ViewValue = $this->ID_Delivery->CurrentValue;
			$this->ID_Delivery->ViewCustomAttributes = "";

			// In_Year
			$this->In_Year->ViewValue = $this->In_Year->CurrentValue;
			$this->In_Year->ViewValue = FormatNumber($this->In_Year->ViewValue, 0, -2, -2, -2);
			$this->In_Year->ViewCustomAttributes = "";

			// In_Month
			$this->In_Month->ViewValue = $this->In_Month->CurrentValue;
			$this->In_Month->ViewValue = FormatNumber($this->In_Month->ViewValue, 0, -2, -2, -2);
			$this->In_Month->ViewCustomAttributes = "";

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->ViewCustomAttributes = "";

			// ProductName
			$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
			$this->ProductName->ViewCustomAttributes = "";

			// OpeningStock
			$this->OpeningStock->ViewValue = $this->OpeningStock->CurrentValue;
			$this->OpeningStock->ViewValue = FormatNumber($this->OpeningStock->ViewValue, 0, -2, -2, -2);
			$this->OpeningStock->ViewCustomAttributes = "";

			// PCS_IN
			$this->PCS_IN->ViewValue = $this->PCS_IN->CurrentValue;
			$this->PCS_IN->ViewValue = FormatNumber($this->PCS_IN->ViewValue, 0, -2, -2, -2);
			$this->PCS_IN->ViewCustomAttributes = "";

			// PCS_OUT
			$this->PCS_OUT->ViewValue = $this->PCS_OUT->CurrentValue;
			$this->PCS_OUT->ViewValue = FormatNumber($this->PCS_OUT->ViewValue, 0, -2, -2, -2);
			$this->PCS_OUT->ViewCustomAttributes = "";

			// ClosingStock
			$this->ClosingStock->ViewValue = $this->ClosingStock->CurrentValue;
			$this->ClosingStock->ViewValue = FormatNumber($this->ClosingStock->ViewValue, 0, -2, -2, -2);
			$this->ClosingStock->ViewCustomAttributes = "";

			// LockStock
			$this->LockStock->ViewValue = $this->LockStock->CurrentValue;
			$this->LockStock->ViewValue = FormatNumber($this->LockStock->ViewValue, 0, -2, -2, -2);
			$this->LockStock->ViewCustomAttributes = "";

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// In_Year
			$this->In_Year->EditAttrs["class"] = "form-control";
			$this->In_Year->EditCustomAttributes = "";
			$this->In_Year->EditValue = HtmlEncode($this->In_Year->CurrentValue);
			$this->In_Year->PlaceHolder = RemoveHtml($this->In_Year->caption());

			// In_Month
			$this->In_Month->EditAttrs["class"] = "form-control";
			$this->In_Month->EditCustomAttributes = "";
			$this->In_Month->EditValue = HtmlEncode($this->In_Month->CurrentValue);
			$this->In_Month->PlaceHolder = RemoveHtml($this->In_Month->caption());

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// ProductName
			$this->ProductName->EditAttrs["class"] = "form-control";
			$this->ProductName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
			$this->ProductName->EditValue = HtmlEncode($this->ProductName->CurrentValue);
			$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

			// OpeningStock
			$this->OpeningStock->EditAttrs["class"] = "form-control";
			$this->OpeningStock->EditCustomAttributes = "";
			$this->OpeningStock->EditValue = HtmlEncode($this->OpeningStock->CurrentValue);
			$this->OpeningStock->PlaceHolder = RemoveHtml($this->OpeningStock->caption());

			// PCS_IN
			$this->PCS_IN->EditAttrs["class"] = "form-control";
			$this->PCS_IN->EditCustomAttributes = "";
			$this->PCS_IN->EditValue = HtmlEncode($this->PCS_IN->CurrentValue);
			$this->PCS_IN->PlaceHolder = RemoveHtml($this->PCS_IN->caption());

			// PCS_OUT
			$this->PCS_OUT->EditAttrs["class"] = "form-control";
			$this->PCS_OUT->EditCustomAttributes = "";
			$this->PCS_OUT->EditValue = HtmlEncode($this->PCS_OUT->CurrentValue);
			$this->PCS_OUT->PlaceHolder = RemoveHtml($this->PCS_OUT->caption());

			// ClosingStock
			$this->ClosingStock->EditAttrs["class"] = "form-control";
			$this->ClosingStock->EditCustomAttributes = "";
			$this->ClosingStock->EditValue = HtmlEncode($this->ClosingStock->CurrentValue);
			$this->ClosingStock->PlaceHolder = RemoveHtml($this->ClosingStock->caption());

			// LockStock
			$this->LockStock->EditAttrs["class"] = "form-control";
			$this->LockStock->EditCustomAttributes = "";
			$this->LockStock->EditValue = HtmlEncode($this->LockStock->CurrentValue);
			$this->LockStock->PlaceHolder = RemoveHtml($this->LockStock->caption());

			// Add refer script
			// In_Year

			$this->In_Year->LinkCustomAttributes = "";
			$this->In_Year->HrefValue = "";

			// In_Month
			$this->In_Month->LinkCustomAttributes = "";
			$this->In_Month->HrefValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// ProductName
			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";

			// OpeningStock
			$this->OpeningStock->LinkCustomAttributes = "";
			$this->OpeningStock->HrefValue = "";

			// PCS_IN
			$this->PCS_IN->LinkCustomAttributes = "";
			$this->PCS_IN->HrefValue = "";

			// PCS_OUT
			$this->PCS_OUT->LinkCustomAttributes = "";
			$this->PCS_OUT->HrefValue = "";

			// ClosingStock
			$this->ClosingStock->LinkCustomAttributes = "";
			$this->ClosingStock->HrefValue = "";

			// LockStock
			$this->LockStock->LinkCustomAttributes = "";
			$this->LockStock->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID_Delivery->Required) {
			if (!$this->ID_Delivery->IsDetailKey && $this->ID_Delivery->FormValue != NULL && $this->ID_Delivery->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Delivery->caption(), $this->ID_Delivery->RequiredErrorMessage));
			}
		}
		if ($this->In_Year->Required) {
			if (!$this->In_Year->IsDetailKey && $this->In_Year->FormValue != NULL && $this->In_Year->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->In_Year->caption(), $this->In_Year->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->In_Year->FormValue)) {
			AddMessage($FormError, $this->In_Year->errorMessage());
		}
		if ($this->In_Month->Required) {
			if (!$this->In_Month->IsDetailKey && $this->In_Month->FormValue != NULL && $this->In_Month->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->In_Month->caption(), $this->In_Month->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->In_Month->FormValue)) {
			AddMessage($FormError, $this->In_Month->errorMessage());
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->ProductName->Required) {
			if (!$this->ProductName->IsDetailKey && $this->ProductName->FormValue != NULL && $this->ProductName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProductName->caption(), $this->ProductName->RequiredErrorMessage));
			}
		}
		if ($this->OpeningStock->Required) {
			if (!$this->OpeningStock->IsDetailKey && $this->OpeningStock->FormValue != NULL && $this->OpeningStock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OpeningStock->caption(), $this->OpeningStock->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OpeningStock->FormValue)) {
			AddMessage($FormError, $this->OpeningStock->errorMessage());
		}
		if ($this->PCS_IN->Required) {
			if (!$this->PCS_IN->IsDetailKey && $this->PCS_IN->FormValue != NULL && $this->PCS_IN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_IN->caption(), $this->PCS_IN->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS_IN->FormValue)) {
			AddMessage($FormError, $this->PCS_IN->errorMessage());
		}
		if ($this->PCS_OUT->Required) {
			if (!$this->PCS_OUT->IsDetailKey && $this->PCS_OUT->FormValue != NULL && $this->PCS_OUT->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_OUT->caption(), $this->PCS_OUT->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS_OUT->FormValue)) {
			AddMessage($FormError, $this->PCS_OUT->errorMessage());
		}
		if ($this->ClosingStock->Required) {
			if (!$this->ClosingStock->IsDetailKey && $this->ClosingStock->FormValue != NULL && $this->ClosingStock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClosingStock->caption(), $this->ClosingStock->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClosingStock->FormValue)) {
			AddMessage($FormError, $this->ClosingStock->errorMessage());
		}
		if ($this->LockStock->Required) {
			if (!$this->LockStock->IsDetailKey && $this->LockStock->FormValue != NULL && $this->LockStock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LockStock->caption(), $this->LockStock->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->LockStock->FormValue)) {
			AddMessage($FormError, $this->LockStock->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// In_Year
		$this->In_Year->setDbValueDef($rsnew, $this->In_Year->CurrentValue, 0, FALSE);

		// In_Month
		$this->In_Month->setDbValueDef($rsnew, $this->In_Month->CurrentValue, 0, FALSE);

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, "", FALSE);

		// ProductName
		$this->ProductName->setDbValueDef($rsnew, $this->ProductName->CurrentValue, "", FALSE);

		// OpeningStock
		$this->OpeningStock->setDbValueDef($rsnew, $this->OpeningStock->CurrentValue, NULL, strval($this->OpeningStock->CurrentValue) == "");

		// PCS_IN
		$this->PCS_IN->setDbValueDef($rsnew, $this->PCS_IN->CurrentValue, NULL, strval($this->PCS_IN->CurrentValue) == "");

		// PCS_OUT
		$this->PCS_OUT->setDbValueDef($rsnew, $this->PCS_OUT->CurrentValue, NULL, strval($this->PCS_OUT->CurrentValue) == "");

		// ClosingStock
		$this->ClosingStock->setDbValueDef($rsnew, $this->ClosingStock->CurrentValue, NULL, FALSE);

		// LockStock
		$this->LockStock->setDbValueDef($rsnew, $this->LockStock->CurrentValue, NULL, strval($this->LockStock->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_inventorylist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>