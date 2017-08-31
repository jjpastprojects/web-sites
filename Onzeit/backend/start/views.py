"""
made by lucas
"""
from django.contrib.auth.models import User, Group
from rest_framework import viewsets
from start.serializers import UserSerializer, GroupSerializer

"""
made by lucas
"""

class UserViewSet(viewsets.ModelViewSet):
    queryset = User.objects.all().order_by('-date_joined')
    serializer_class = UserSerializer

"""
made by lucas
"""

class GroupViewSet(viewsets.ModelViewSet):
    queryset = Group.objects.all()
    serializer_class = GroupSerializer