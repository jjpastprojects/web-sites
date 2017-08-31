from __future__ import unicode_literals

from django.db import models
from django.core.validators import MaxValueValidator, MinValueValidator

# Create your models here.
class BaseUser(models.Model):
    username = models.CharField(max_length=254, unique=True)
    email = models.EmailField(blank=True)
    password = models.CharField(max_length=30, blank=True)
    is_employee = models.BooleanField(default=True)
    is_verified = models.BooleanField(default=False)

    #first_name = models.CharField(max_length=30, blank=True)
    #last_name = models.CharField(max_length=30, blank=True)

class Employee(models.Model):
    username = models.CharField(max_length=254, unique=True)
    email = models.EmailField(blank=False, unique=True)
    password = models.CharField(max_length=64, blank=True)

    city = models.CharField(max_length=30, blank=True)
    phone = models.CharField(max_length=30, blank=True)
    is_verified = models.BooleanField(default=False)

    zipcode = models.CharField(max_length=5, blank=False, verbose_name='zip cdoe')
    distance = models.IntegerField(default=100, validators=[MaxValueValidator(100), MinValueValidator(1)], verbose_name='distance')
    ssn = models.CharField(max_length=30, blank=True, verbose_name='Social Security Number')

    verify_phone = models.CharField(max_length=20, blank=True)
    last_verified = models.DateTimeField(blank=True, null=True)
    passcode = models.CharField(max_length=20, blank=True)

    def __unicode__(self):
        return u'%s / %s' % (self.username, self.email)

    
class Employer(models.Model):
    username = models.CharField(max_length=254, unique=True)
    email = models.EmailField(blank=False, unique=True)
    password = models.CharField(max_length=64, blank=True)

    is_verified = models.BooleanField(default=False)
    fb_name = models.CharField(max_length=40, blank=True, verbose_name='Full Buiness Name')
    ac_name = models.CharField(max_length=40, blank=True, verbose_name='Account Contact Name')
    ss_no = models.CharField(max_length=40, blank=True, verbose_name='Fein or Social Security Number if Sole Proprietor')
    bm_addr = models.CharField(max_length=40, blank=True, verbose_name='Business Mailing Address')
    city = models.CharField(max_length=20, blank=True)
    state = models.CharField(max_length=20, blank=True)
    z_code = models.CharField(max_length=10, blank=True, verbose_name='zip code')
    o_phone = models.CharField(max_length=20, blank=True, verbose_name='office phone')
    c_phone = models.CharField(max_length=20, blank=True, verbose_name='cell phone')
    w_phone = models.CharField(max_length=20, blank=True, verbose_name='work phone')
    b_fax = models.CharField(max_length=40, blank=True, verbose_name='business fax')

    zipcode = models.CharField(max_length=5, blank=False, verbose_name='zip code')
    distance = models.IntegerField(default=100, validators=[MaxValueValidator(100), MinValueValidator(1)], verbose_name='distance')

    verify_phone = models.CharField(max_length=20, blank=True)
    last_verified = models.DateTimeField(blank=True, null=True)
    passcode = models.CharField(max_length=20, blank=True)

    def __unicode__(self):
        return u'%s / %s' % (self.username, self.email)



class VerificationDetails(models.Model):
    """
    This model stores a small set of data needed to conduct the 2 factor
    authentication
    """
    user = models.OneToOneField(BaseUser, related_name='verify_details')
    phone = models.CharField(max_length=20, blank=True)
    last_verified = models.DateTimeField(blank=True, null=True)
    enabled = models.BooleanField(default=True)
    passcode = models.CharField(max_length=20, blank=True)

