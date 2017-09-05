module StatsClient
  module BaseResource

    module InstanceMethods
      def method_missing(method, value)
        eigenclass = class << self;
          self;
        end
        method = method.to_s.gsub /\=/, ''

        eigenclass.class_eval do
          define_method(method) do
            value
          end
        end
      end


      def copy_instance_variables_from_hash(hash, parent_hash = {})
        hash = slice_response_hash(hash)
        hash.keys.each do |key|
          send "#{self.method_name_for_attr(key)}=", hash[key]
        end

        if parent_hash.present?
          parent_hash.each do |key|
            send "#{self.method_name_for_attr(key)}=", parent_hash[key]
          end
        end
      end

      def slice_response_hash(response)
        response
      end
    end

    module ClassMethods
      def method_name_for_attr(attr)
        #NOET: this code is borrowed from Rails
        #https://github.com/rails/rails/blob/feaa6e2048fe86bcf07e967d6e47b865e42e055b/activesupport/lib/active_support/inflector/methods.rb#L89
        word = attr.to_s.dup
        word.gsub!('::', '/')
        word.gsub!(/(?:([A-Za-z\d])|^)(#{/(?=a)b/})(?=\b|[^a-z])/) { "#{$1}#{$1 && '_'}#{$2.downcase}" }
        word.gsub!(/([A-Z\d]+)([A-Z][a-z])/, '\1_\2')
        word.gsub!(/([a-z\d])([A-Z])/, '\1_\2')
        word.tr!("-", "_")
        word.downcase!
        word
      end
    end

    include InstanceMethods

    def self.included(klass)
      klass.extend ClassMethods
    end
  end
end