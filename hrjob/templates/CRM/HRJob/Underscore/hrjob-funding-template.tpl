{literal}
<script id="hrjob-funding-template" type="text/template">
<form>
  <% if (!_.isEmpty(rolesInfo)) {%>
    <table class="funding-role-info-table">
      <thead>
        <tr class="hrjob-funding-role-header">
          <th>{/literal}Role Title(s){literal}</th>
          <th>{/literal}Name of the Funder(s){literal}</th>
          <th>{/literal}Percent of pay assigned to Role{literal}</th>
        </tr>
      </thead>
      <tbody>
        <% _.each(rolesInfo, function(roleInfo, roleId) { %>
          <tr class="-list-item">
            <td class="hrjob-funding-role-position-<%= roleId %>"><%- roleInfo.position %></td>
            <td class="hrjob-funding-role-funders">
              <% _.each(roleInfo.funder, function(funderId){  %>
                <div><a href="#" class="hrjob-funding-role-funder" id="hrjob-role-funder-<%- funderId %>"/></div><hr/>
              <% }) %>

            </td>
            <td class="hrjob-funding-role-percent-assigned-toRole"><%- roleInfo.percentPay %></td>
          </tr>
        <% }); %>
      </tbody>
    </table>
  <% } %>
  <h3>{/literal}{ts}Funding{/ts}{literal}</h3>
  <div class="crm-summary-row">
    <div class="crm-label">
      <label for="hrjob-funding_notes">{/literal}{ts}Funding Notes{/ts}{literal}</label>
    </div>
    <div class="crm-content">
      <textarea id="hrjob-funding_notes" name="funding_notes"></textarea>
    </div>
  </div>

  <% if (!isNewDuplicate) { %>
  <button class="crm-button standard-save">{/literal}{ts}Save{/ts}{literal}</button>
  <% } else { %>
  <button class="crm-button standard-save">{/literal}{ts}Save New Copy{/ts}{literal}</button>
  <% } %>
  <button class="crm-button standard-reset">{/literal}{ts}Reset{/ts}{literal}</button>
</form>
</script>
{/literal}
