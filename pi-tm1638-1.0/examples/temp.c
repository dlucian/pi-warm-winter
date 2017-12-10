/**
 *
 * @file
 * @brief   Hello World for TM1638 based displays
 * @author  Martin Oldfield <ex-tm1638@mjo.tc>
 * @version 0.1
 *
 * @section DESCRIPTION
 *
 * A simple "Hello World" example program for the TM1638.
 *
 * @section HARDWARE
 *
 * The code hard wires pin connections:
 *
 *    * data: GPIO 17
 *    * clock: GPIO 21
 *    * strobe: GPIO 22
 *
 * @section LICENSE
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details at
 * http://www.gnu.org/copyleft/gpl.html
 *
 */

/** @cond NEVER */

#include <ctype.h>
#include <unistd.h>

#include <stdio.h>
#include <stdlib.h>

#include <stdint.h>
#include <stdbool.h>

#include <bcm2835.h>
#include <tm1638.h>

static void knight_rider(tm1638_p t, int n);
static void flashy(tm1638_p t);

int main(int argc, char *argv[])
{
  char *ledText = NULL;
  int leds = -1;
  int index;
  int c;

  opterr = 0;

  while ((c = getopt (argc, argv, "l:d:")) != -1)
    switch (c)
      {
      case 'd':
        ledText = optarg;
        break;
      case 'l':
        leds = atoi(optarg);
        break;
      case '?':
        if (optopt == 'l' || optopt == 'd')
          fprintf (stderr, "Option -%c requires an argument.\n", optopt);
        else if (isprint (optopt))
          fprintf (stderr, "Unknown option `-%c'.\n", optopt);
        else
          fprintf (stderr,
                   "Unknown option character `\\x%x'.\n",
                   optopt);
        return 1;
      default:
        abort ();
      }

  for (index = optind; index < argc; index++)
    printf ("Non-option argument %s\n", argv[index]);

  if (! ledText && leds < 0) 
    {
      printf ("Options: -l NUMBER -d TEXT\n");
      abort ();
    }

  tm1638_p t;

  if (!bcm2835_init())
    {
      printf("Unable to initialize BCM library\n");
      return -1;
    }

  t = tm1638_alloc(17, 27, 22);
  if (!t)
    {
      printf("Unable to allocate TM1638\n");
      return -2;
    }

  if (ledText)
    {
      printf("Set LED Text: %s\n", ledText);
      // the third parameter is a binary where to set the digit dots
      tm1638_set_7seg_text(t, ledText, 0b01000100);
    }

  if (leds >= 0)
    {
      printf("Set LEDs: %d\n", leds);
      tm1638_set_8leds(t, leds, 0);
    }

  // tm1638_send_cls(t); // this will erase everything
  tm1638_free(&t);

  return 0;
}

/** @endcond */
