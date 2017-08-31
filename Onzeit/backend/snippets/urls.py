"""
made by lucas
"""
from django.conf.urls import url, include
from snippets import views
from rest_framework.urlpatterns import format_suffix_patterns
"""
made by lucas
"""
urlpatterns = [
    ########################################################################
    ##### function based url
    ########################################################################
    # url(r'^snippets/$', views.snippet_list),
    # url(r'^snippets/(?P<pk>[0-9]+)/$', views.snippet_detail),
    ########################################################################
    ##### function based url
    ########################################################################
    url(r'^snippets/$', views.SnippetList.as_view()),
    url(r'^snippets/(?P<pk>[0-9]+)/$', views.SnippetDetail.as_view()),
    url(r'^users/$', views.UserList.as_view()),
    url(r'^users/(?P<pk>[0-9]+)/$', views.UserDetail.as_view()),
]

urlpatterns += [
    url(r'^api-auth/', include('rest_framework.urls',
                               namespace='rest_framework')),
]

urlpatterns = format_suffix_patterns(urlpatterns)