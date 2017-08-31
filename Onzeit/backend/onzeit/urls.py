from django.conf.urls import url, include
from django.conf import settings
from django.contrib import admin
from django.contrib.auth.models import User, Group
from rest_framework import routers
from start import views
from django.views.generic import RedirectView


"""
made by lucas
"""
urlpatterns = [
    # url(r'^', include(router.urls)),
    url(r'^admin/', include(admin.site.urls)),
    url(r'^account/', include('account.urls')),
    url(r'^', include('snippets.urls')),
    url(r'^api-auth/', include('rest_framework.urls', namespace='rest_framework')),

    url(r'^$', RedirectView.as_view(url=settings.HOMEPAGE_URL))
]

"""
made by lucas
"""
# Change admin site title
admin.autodiscover()
admin.site.unregister(User)
admin.site.unregister(Group)
"""
made by lucas
"""
# admin.site.unregister(Site)
admin.site.site_header = 'Onzeit Administration';
admin.site.site_title = 'Onziet Admin'