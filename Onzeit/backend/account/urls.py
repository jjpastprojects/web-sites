"""
made by lucas
"""
from django.conf.urls import url, include
from account import views
from rest_framework.urlpatterns import format_suffix_patterns

urlpatterns = [
    ########################################################################
    ##### function based url
    ########################################################################
    url(r'^employee/register/$', views.employee_list),
    url(r'^employee/(?P<pk>[0-9]+)/$', views.employee_detail),

    url(r'^employer/register/$', views.employer_list),
    url(r'^employer/(?P<pk>[0-9]+)/$', views.employer_detail),

    url(r'^employee/generate_passcode/$', views.generate_passcode, {'type': 'employee'}),
    url(r'^employer/generate_passcode/$', views.generate_passcode, {'type': 'employer'}),

    url(r'^employee/verify_passcode/$', views.verify_passcode, {'type': 'employee'}),
    url(r'^employer/verify_passcode/$', views.verify_passcode, {'type': 'employer'}),

    url(r'^employee/login/$', views.login, {'type': 'employee'}),
    url(r'^employer/login/$', views.login, {'type': 'employer'}),

    url(r'^employee/newhireintake/$', views.newhireintake),

]


urlpatterns = format_suffix_patterns(urlpatterns)