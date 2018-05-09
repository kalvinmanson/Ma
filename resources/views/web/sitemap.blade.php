<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  <url>
    <loc>https://ma.edu.co/</loc>
    <changefreq>daily</changefreq>
    <priority>9.00</priority>
  </url>
  @foreach($grades as $grade)
    @foreach($grade->courses as $course)
    <url>
      <loc>https://ma.edu.co/g/{{ $course->grade->slug }}/c/{{ $course->slug}}</loc>
      <changefreq>daily</changefreq>
      <priority>8.50</priority>
    </url>
    @endforeach
  @endforeach
  @foreach($contents as $content)
  <url>
    <loc>https://ma.edu.co/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}</loc>
    <changefreq>monthly</changefreq>
    <priority>1.00</priority>
  </url>
  @endforeach
  @foreach($activities as $activity)
  <url>
    <loc>https://ma.edu.co/g/{{ $activity->course->grade->slug }}/c/{{ $activity->course->slug }}/activities/{{ $activity->slug }}</loc>
    <changefreq>monthly</changefreq>
    <priority>7.00</priority>
  </url>
  @endforeach
  @foreach($topics as $topic)
  <url>
    <loc>https://ma.edu.co/g/{{ $topic->course->grade->slug }}/c/{{ $topic->course->slug }}/forum/{{ $topic->slug }}</loc>
    <changefreq>weekly</changefreq>
    <priority>8.00</priority>
  </url>
  @endforeach
</urlset>
