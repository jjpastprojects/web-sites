"""
made by lucas
"""
from django.contrib.auth.models import User, Group
from rest_framework import serializers

"""
made by lucas
"""

class UserSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = User
        fields = ('url', 'username', 'email', 'groups')

"""
made by lucas
"""

class GroupSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Group
        fields = ('url', 'name')