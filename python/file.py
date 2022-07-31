#!/usr/bin/python3
import sys
import argparse
from google_images_search import GoogleImagesSearch

def createParser():
   parser = argparse.ArgumentParser()
   parser.add_argument('ean')
   return parser

# you can provide API key and CX using arguments,
# or you can set environment variables: GCS_DEVELOPER_KEY, GCS_CX
gis = GoogleImagesSearch('AIzaSyCAbdU-fEueJXk2hrFF1P0ifXJlI7fOIYM', '016457930339882104002:yzs1o7hqmiq')

if __name__ == '__main__':
   parser = createParser()
   namespace = parser.parse_args(sys.argv[2:])
   

if namespace.ean:
   word = format(namespace.ean)
   # define search params:
   _search_params = {'q': word,'num': 3,'fileType':'jpg','imgType':'photo'}

   _path_folder = '/var/www/html/laravelapp/python/downloads/' + word;
   # this will search and download:
   gis.search(search_params=_search_params, path_to_dir=_path_folder)
