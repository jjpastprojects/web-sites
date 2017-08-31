from django.contrib import admin
from account.models import Employee, Employer
# Register your models here.

class EmployeeAdmin(admin.ModelAdmin):
    list_display = ('username', 'email', 'password', 'city', 'phone', 'zipcode', 'distance', 'ssn', 'is_verified')

class EmployerAdmin(admin.ModelAdmin):
    list_display = ('username', 'email', 'password', 'is_verified', 'fb_name', 'ac_name', 'ss_no', 'bm_addr', 'city', 'state', 'zipcode', 'distance', 'o_phone', 'c_phone', 'w_phone', 'b_fax')

admin.site.register(Employee, EmployeeAdmin)
admin.site.register(Employer, EmployerAdmin)