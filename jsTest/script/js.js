$(document).ready(function() {
  /**
   * Builds Table
   * @param {*} customers 
   * @param {*} containerId 
   */
    function CustomerTable(customers, containerId) {
        this.customers = customers;
        this.containerId = containerId;
        this.table = $('<table>');
        this.thead = $('<thead>').appendTo(this.table);
        this.tbody = $('<tbody>').appendTo(this.table);
    }

    /**
     * Adds table headers to CustomerTable object
     */
    CustomerTable.prototype.buildTableHeaders = function() {
        let headers = Object.keys(this.customers[0]);
        let headerRow = $('<tr>').appendTo(this.thead);

        headers.forEach(function(header) {
          $('<th>').text(header.charAt(0).toUpperCase() + header.slice(1)).appendTo(headerRow);           
        });

        $('<th>').text("Age").appendTo(headerRow);
    };

    /**
     * Builds all the rows from data.js and adds to CustomerTable object
     */
    CustomerTable.prototype.buildTableRows = function() {
        let self = this;

        this.customers.forEach(function(customer) {
            let row = $('<tr>').appendTo(self.tbody);

            Object.entries(customer).forEach(function([key, value]) {
                $('<td>').text(value).appendTo(row);
            });

            Object.entries(customer).forEach(function([key, value]) {
              if(key == "birthdate"){
                let age = self.calculateAge(value);
                $('<td>').text(age).appendTo(row);
              }
            });
        });
    };

    /**
     * Calculates age of each customer
     * @param {*} birthdate 
     * @returns 
     */
    CustomerTable.prototype.calculateAge = function(birthdate) {
        let today = new Date();
        let birthdateObj = new Date(birthdate);
        let age = today.getFullYear() - birthdateObj.getFullYear();
        let monthDiff = today.getMonth() - birthdateObj.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdateObj.getDate())) {
          age--;
        }

        return age;
      };
    
    /**
     * Adds Headers and rows to table object and then displays it inside html container
     */
    CustomerTable.prototype.buildTable = function() {
        this.buildTableHeaders();
        this.buildTableRows();

        $(this.containerId).append(this.table);
    };

    /**
     * Filters table based on age rage
     * ex: 20-30
     * @param {*} range 
     */
    function filterTable(range) {
      let rangeValues = range.split('-').map(function(num) {
        return parseInt(num.trim(), 10);
      });
      
      let filteredCustomers = customers.filter(function(customer) {
        let age = customerTable.calculateAge(customer.birthdate);

        return age >= rangeValues[0] && age <= rangeValues[1];
      });
  
      customerTable.tbody.empty();

      filteredCustomers.forEach(function(customer) {
        let row = $('<tr>').appendTo(customerTable.tbody);

        Object.values(customer).forEach(function(value) {
          $('<td>').text(value).appendTo(row);
        });

        let age = customerTable.calculateAge(customer.birthdate);
        $('<td>').text(age).appendTo(row);

      });
    }


    let customerTable = new CustomerTable(customers, "#dataContainer");

    customerTable.buildTable();

    /**
     * Adds filter function to text input
     */
    $('#searchCustomer').on('keyup', function() {
      let value = $(this).val();

      if (value.includes('-')) {
        filterTable(value);
      } else {
        let filteredCustomers = customers.filter(function(customer) {
          return customer.name.toLowerCase().includes(value.toLowerCase());
        });
  
        customerTable.tbody.empty();

        filteredCustomers.forEach(function(customer) {
          let row = $('<tr>').appendTo(customerTable.tbody);

          Object.values(customer).forEach(function(value) {
            $('<td>').text(value).appendTo(row);
          });

          let age = customerTable.calculateAge(customer.birthdate);
          $('<td>').text(age).appendTo(row);

        });
      }
    });
});